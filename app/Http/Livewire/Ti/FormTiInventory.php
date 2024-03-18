<?php

namespace App\Http\Livewire\Ti;

use App\Models\Roma\BranchOffice;
use App\Models\Ti\Inventory;
use App\Models\Ti\TiProduct;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormTiInventory extends Component
{

    public Inventory $inventory;
    public $year;
    public $statuses = [ 'Por retirar', 'Retirar', 'Recambio'];
    public $phone;

    public function rules(): array
    {
        return [
            'inventory.tiProduct_id' => [ 'required' ],
            'inventory.user_id' => [ 'required' ],
            'inventory.branch_id' => [ 'required' ],
            'inventory.brand' => [ 'required' ],
            'inventory.serial_number' => [ 'required' ],
            'inventory.year' => [ 'required' ],
            'inventory.imei' => [ 'required_if:phone,true' ],
            'inventory.phone_number' => [ 'required_if:phone,true' ],
            'inventory.status' => [ 'required' ],
            'inventory.origin' => [ 'required' ],
            'inventory.observation' => [ 'required'],
         ];
    }

    public $messages = [
        'inventory.tiProduct_id.required' => 'Este campo es requerido',
        'inventory.user_id.required' => 'Este campo es requerido',
        'inventory.branch_id.required' => 'Este campo es requerido',
        'inventory.brand.required' => 'Este campo es requerido',
        'inventory.serial_number.required' => 'Este campo es requerido',
        'inventory.year.required' => 'Este campo es requerido',
        'inventory.imei.required_if' => 'Este campo es requerido',
        'inventory.phone_number.required_if' => 'Este campo es requerido',
        'inventory.status.required' => 'Este campo es requerido',
        'inventory.origin.required' => 'Este campo es requerido',
        'inventory.observation.required' => 'Este campo es requerido',
    ];

    public function mount(): void
    {
        $this->inventory = new Inventory;
        $this->year = $this->years();
    }

    public function render(): Renderable
    {
        return view('livewire.ti.form-ti-inventory', [
            'users' => User::select('ID', 'Nombre' )->orderBy('Nombre', 'ASC')->get()->toArray(),
            'branchOffices' => BranchOffice::select( 'ID', 'Sucursal' )->orderBy('Sucursal', 'ASC')->get()->toArray(),
            'tiProducts' => TiProduct::select( 'id', 'name' )->orderBy('name', 'ASC')->get()->toArray(),
        ]);
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $this->inventory->save();
        });

        $this->alertSuccess('success', 'Inventario guardado!!!');

        $this->inventory = new Inventory;
    }

    public function alertSuccess($type, $message): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }

    private function years(): array
    {
        $years = array();

        for ($year = 2000; $year <= 2023; $year++)
        {
            $years[$year] = $year;
        }
        return $years;
    }
}
