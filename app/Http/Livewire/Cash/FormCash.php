<?php

namespace App\Http\Livewire\Cash;

use App\Mail\ApprovalRendition;
use App\Models\Cash\Cash;
use App\Models\Cash\CashAccount;
use App\Models\Cash\CashDetail;
use App\Models\Cash\CashierApprovals;
use App\Models\Cash\CashierApprover;
use App\Models\Cash\Document;
use App\Models\Cash\FileCash;
use App\Models\Cash\UserBankAccount;
use App\Models\Roma\Bank;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormCash extends Component
{
    use WithFileUploads;

    private int $total_cash = 0;
    public $branchOffice;
    public array $banks = [];
    public $bank;
    public $detail = [];
    public $files = [];
    public $accounts;
    public array $branchOffices = [];
    public $documents;
    public array $inputs = [];
    public int $i = 0;
    public $account_number;
    public $account_type;
    public int $total_cash_provisional = 0;

    public function mount()
    {
        $this->branchOffices = auth()->user()->sucursales()->where('CargoID', '<>', 11)->get()->toArray();
        $this->accounts = CashAccount::select( 'name', 'id', 'number_account')->get()->toArray();
        $this->documents = Document::pluck( 'name', 'id' );
        $this->banks = Bank::select( 'Banco', 'ID' )->get()->toArray();
        $account_user = UserBankAccount::where('user_id', auth()->user()->ID)->first();
        $this->bank = $account_user->bank_id ?? '';
        $this->account_number = $account_user->account_number ?? '';
        $this->account_type = $account_user->account_type ?? '';
    }
    public function render(): Renderable
    {
        return view('livewire.cash.form-cash');
    }

    public function add( $i ): void
    {
        $i = $i + 1;
        $this->i = $i;
        $this->inputs[] = $i;
    }

    public function remove( $index, $value ): void
    {
        unset($this->inputs[$index]);
        unset($this->detail[$value]);
    }

    protected function rules(): array
    {
        return [
            'branchOffice' => "required|exists:MA_Sucursales,ID",
            'detail.*.document' => 'required',
            'detail.*.date' => 'required',
            'detail.*.type' => 'required',
            'detail.*.provider' => 'required',
            'detail.*.description' => 'required',
            'detail.*.amount' => 'required',
            'detail.*.account' => 'required',
            'detail.*.file' => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
            'bank' => 'required|exists:MA_Bancos,ID',
            'account_number' => 'required',
            'account_type' => 'required',
        ];
    }

    protected $messages = [
        'branchOffice.required' => 'El campo es requerido',
        'branchOffice.exists' => 'La sucursal seleccionada no existe',
        'detail.*.document.required' => 'El campo es requerido',
        'detail.*.date.required' => 'El campo es requerido',
        'detail.*.type.required' => 'El campo es requerido',
        'detail.*.provider.required' => 'El campo es requerido',
        'detail.*.description.required' => 'El campo es requerido',
        'detail.*.amount.required' => 'El campo es requerido',
        'detail.*.account.required' => 'El campo es requerido',
        'detail.*.file.required' => 'El campo es requerido',
        'detail.*.file.max' => 'El archivo no debe pesar más de 2MB',
        'detail.*.file.mimes' => 'El archivo debe ser de tipo PDF, JPG, JPEG o PNG',
        'bank.required' => 'El campo es requerido',
        'bank.exists' => 'El banco seleccionado no existe',
        'account_number.required' => 'El campo es requerido',
        'account_type.required' => 'El campo es requerido',
    ];

    public function store(): void
    {
        if (empty($this->detail)) {
            $this->alertSuccess('error', 'Debe agregar al menos un registro');
            return;
        }

        $this->validate();

        DB::transaction(function()
        {
            $cash = new Cash();
            $cash->user_id = auth()->user()->ID;
            $cash->branch_office_id = $this->branchOffice;
            $cash->total = $this->total_cash;
            $cash->save();

            foreach ($this->detail as $key => $value) {
                $cashDetail = new CashDetail();
                $cashDetail->number_document = $value['document'];
                $cashDetail->date = $value['date'];
                $cashDetail->type_document = $value['type'];
                $cashDetail->provider = $value['provider'];
                $cashDetail->description = $value['description'];
                $cashDetail->account_id = $value['account'];
                $cashDetail->total = str_replace( ".", "", @$value['amount'] );
                $cashDetail->cash_id = $cash->id;
                $cashDetail->save();

                $path = $value['file']->store('cash', 'public');

                $this->saveFiles( $path, $cashDetail->id );

                $this->total_cash += str_replace( ".", "", $value['amount'] );
            }

            UserBankAccount::updateOrCreate(
                [
                    'user_id' => auth()->user()->ID,
                    'bank_id' => $this->bank,
                    'account_number' => $this->account_number,
                    'account_type' => $this->account_type,
                ],
                [
                    'user_id' => auth()->user()->ID,
                    'bank_id' => $this->bank,
                    'account_number' => $this->account_number,
                    'account_type' => $this->account_type,
                ]
            );

            $cash->update( [ 'total' => $this->total_cash ] );

            $this->approvalRecord( $cash->id, $cash->branch_office_id );

            $this->alertSuccess('success', 'Registro agregado correctamente');
        });

        $this->inputs = [];
        $this->branchOffice = '';

        $this->resetInputFields();
    }

    private function resetInputFields(): void
    {
        $this->detail = '';
    }

    public function alertSuccess($type, $message): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }

    private function approvalRecord( int $id,  int $branchOffice): void
    {
        $approver = CashierApprover::with('user:ID,Nombre,Email')->select('user_id', 'level')
            ->where('branch_office_id', $branchOffice)
            ->orderBy('level', 'asc')
            ->get()
            ->toArray();

        if (empty($approver)){
            $this->alertSuccess('error', 'No se encontraron aprobadores para esta sucursal');
        }

        foreach ($approver as $key => $item) {
            $cashierApprovals = CashierApprovals::create([
                'cash_id' => $id,
                'cashier_approver_id' => $item['user_id'],
                'level' => $item['level'],
                'state' => $key === 0 ? 1 : 0
            ]);
        }

        try {
            Mail::mailer('roma')
                ->to( $approver[0]['user']['Email'] )
                ->send(new ApprovalRendition( $approver[0]['user']['Nombre'], $id, "Asignación de Rendición", "Le fue asignada para ser gestionada", $this->detail ) );
        }catch (Exception $exception){
            Log::error( "Se produjo un error al enviar correo Caja procesar: $exception");
        }
    }

    private function saveFiles( string $path, int $id ): void
    {
        $f = new FileCash();
        $f->url = $path;
        $f->cash_detail_id = $id;
        $f->save();
    }

    public function updatedDetail( $value, $key )
    {

        if( Str::contains($key, 'amount') ){
            $this->total_cash_provisional = 0;
            foreach ($this->detail as $data) {
                if(!isset($data['amount']))
                    $data['amount']= 0;
                $this->total_cash_provisional +=  str_replace( ".", "", $data['amount'] );
            }
        }elseif ( Str::contains($key, 'file')){
            $this->alertSuccess('success', 'archivo subido!!!');
            $this->total_cash_provisional = 0;
            foreach ($this->detail as $data) {
                if(!isset($data['amount']))
                    $data['amount']= 0;
                $this->total_cash_provisional +=  str_replace( ".", "", $data['amount'] );
            }
        }
    }
}
