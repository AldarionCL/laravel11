<?php

namespace App\Http\Livewire\Operation;

use App\Http\Utils\Workplace;
use App\Mail\NotificationOperationTicket;
use App\Models\OperationTicket\OperationAgent;
use App\Models\OperationTicket\OperationCategory;
use App\Models\OperationTicket\OperationFileTicket;
use App\Models\OperationTicket\OperationSubCategory;
use App\Models\OperationTicket\OperationTicket;
use App\Models\Roma\SaveEvent;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class OperationFormTicket extends Component
{
    use WithFileUploads;

    public $brands;
    public $businessAreas;
    public $branches;
    public $categories;
    public $subCategories;
    public $file;
    public $agent;
    public $total;
    public $location;
    public $priority = ['Baja', 'Normal', 'Alta'];
    public OperationTicket $operationTicket;

    public function getWorkplaceProperty(): Workplace
    {
        return new Workplace();
    }

    public function render(): Renderable
    {

        $this->brands = $this->workplace->brands()->toArray();

        $this->categories = OperationCategory::all()->toArray();

        return view('livewire.operation.operation-form-ticket', [
            'brands' => $this->brands,
            'categories' => $this->categories,
            'amount' => $this->total->count() ?? 0,
            'closed' => $this->total->where('state', 3)->count(),
            'processing' => $this->total->where('state', 2)->count(),
            'open' => $this->total->where('state', 1)->count(),
        ]);
    }

    public function rules(): array
    {
        return [
            'operationTicket.title' => 'required|max:100',
            'operationTicket.priority' => 'required',
            'operationTicket.category' => 'required|exists:TKo_categories,ID',
            'operationTicket.subCategory' => "required|exists:TKo_sub_categories,id,category_id,{$this->operationTicket->category}",
            'operationTicket.management' => 'required|exists:MA_Gerencias,ID',
            'operationTicket.zone' => 'required|exists:MA_TipoSucursal,ID',
            'operationTicket.department' => "required|exists:MA_Sucursales,ID,GerenciaID,{$this->operationTicket->management}",
            'operationTicket.detail' => 'required',
            'file' => 'nullable|mimes:jpg,png,xls,xlsx,doc,pdf,docx|max:5000',
            'agent' => 'required'
        ];
    }


    protected $messages = [
        'operationTicket.title.required' => 'Este campo es obligatorio',
        'operationTicket.title.max' => 'El Asunto debe contener máximo 100 cáracteres',
        'operationTicket.priority.required' => 'El campo Prioridad, es obligatorio',
        'operationTicket.category.required' => 'El campo Categoría, es obligatorio',
        'operationTicket.category.exists' => 'La Categoría, no es valida',
        'operationTicket.subCategory.required' => 'El campo Sub Categoría, es obligatorio',
        'operationTicket.subCategory.exists' => 'La Sub Categoría, no es valida',
        'operationTicket.management.required' => 'El campo Marca - Gerencia, es obligatorio',
        'operationTicket.zone.required' => 'El campo Area de Negocio, es obligatorio',
        'operationTicket.zone.exists' => 'La Area de Negocio, no es valida',
        'operationTicket.department.required' => 'El campo Sucursal - Taller - Departamento, es obligatorio',
        'operationTicket.department.exists' => 'La Sucursal - Taller - Departamento, no es valida',
        'operationTicket.detail.required' => 'El campo Descripción, es obligatorio',
        'file.mimes' => 'El archivo debe ser un archivo de tipo: jpg, png, xls, xlsx, doc, pdf, docx.',
        'file.max' => 'El tamaño maximo del archivo es 5mb',
        'agent.required' => 'La Sub Categoría, no tienen agente asignado, favor solicitar a un administrador',
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function mount(): void
    {
        $this->operationTicket = new OperationTicket();
        $this->businessAreas = array();
        $this->branches = array();
        $this->subCategories = array();


        $this->total = countTicketOperation()->get();
    }

    public function updatedOperationTicketManagement( $value )
    {
        return $this->businessAreas = $this->workplace->businessAreas($value)->toArray();
    }

    public function updatedOperationTicketZone( $value )
    {
        return $this->branches = $this->workplace->branches( $this->operationTicket->management,  $value )->toArray();
    }

    public function updatedOperationTicketCategory($value): array
    {
        return $this->subCategories = OperationSubCategory::where('category_id', $value)->get()->toArray();
    }

    public function submit()
    {
        $this->getAgent();

        $this->validate();

        DB::transaction(function () {
            $this->operationTicket->applicant = auth()->user()->ID;
            $this->operationTicket->assigned = $this->agent;
            $this->operationTicket->state = 1;
            $this->operationTicket->FechaCreacion = date('Y-m-d ');
            $this->operationTicket->EventoCreacionID = 129;
            $this->operationTicket->UsuarioCreacionID = auth()->user()->ID;

            $this->operationTicket->save();

            if ($this->file)
            {
                $file = new OperationFileTicket();
                $path = $this->file->store('public/tickets');
                $file->url = $path;
                $file->ticket_id = $this->operationTicket->id;
                $file->save();
            }

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 131;
            $event->UsuarioCreacionID = 3;
            $event->ReferenciaID = $this->operationTicket->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Ticket";
            $event->save();

            try {
                Mail::mailer('mesadeayuda')->to($this->operationTicket->responsible->Email)->send(new NotificationOperationTicket($this->operationTicket));
            }catch (Exception $exception){
                Log::error( "Se produjo un error al enviar correo Operacion: $exception");
            }
        });

        // $this->ticket = new Ticket();

        $this->emit('refreshDatatable');
        $this->alertSuccess();

    }

    /**
     * @return void
     */
    public function getAgent(): void
    {
        $ticket = OperationTicket::where('subCategory', $this->operationTicket->subCategory)->latest()->first();

        if($ticket !== null )
        {
            $agentNext = OperationAgent::where('subCategory_id', $this->operationTicket->subCategory)->where( 'user_id', '>', $ticket['assigned'])->orderBy('id')->first();

            $agentFirst = OperationAgent::where('subCategory_id', $this->operationTicket->subCategory)->orderBy('id')->first()->getAttribute('user_id');

            $this->agent = $agentNext !== null ? $agentNext->getAttribute('user_id') : $agentFirst;
        }else{
            $agentFirst = OperationAgent::where('subCategory_id', $this->operationTicket->subCategory)->orderBy('id')->first()->getAttribute('user_id');

            $this->agent = $agentFirst;
        }

    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Ticket guardado'
        ]);
    }
}
