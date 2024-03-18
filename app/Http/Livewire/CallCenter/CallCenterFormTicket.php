<?php

namespace App\Http\Livewire\CallCenter;

use App\Http\Utils\Workplace;
use App\Mail\NotificationCallCenterTicket;
use App\Models\CallCenterTicket\CallCenterAgent;
use App\Models\CallCenterTicket\CallCenterCategory;
use App\Models\CallCenterTicket\CallCenterFileTicket;
use App\Models\CallCenterTicket\CallCenterSubCategory;
use App\Models\CallCenterTicket\CallCenterTicket;
use App\Models\Roma\SaveEvent;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class CallCenterFormTicket extends Component
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
    public CallCenterTicket $callCenterTicket;

    public function getWorkplaceProperty()
    {
        return new Workplace();
    }

    public function render(): Renderable
    {

        $this->brands = $this->workplace->brands()->toArray();

        $this->categories = CallCenterCategory::all()->toArray();

        return view('livewire.call-center.call-center-form-ticket', [
            'brands' => $this->brands,
            'categories' => $this->categories,
            'amount' => $this->total->count() ?? 0,
            'closed' => $this->total->where('state', 3)->count(),
            'processing' => $this->total->where('state', 2)->count(),
            'open' => $this->total->where('state', 1)->count(),
        ]);
    }

    public function rules()
    {
        return [
            'callCenterTicket.title' => 'required',
            'callCenterTicket.priority' => 'required',
            'callCenterTicket.category' => 'required|exists:TKc_categories,ID',
            'callCenterTicket.subCategory' => "required|exists:TKc_sub_categories,id,category_id,{$this->callCenterTicket->category}",
            'callCenterTicket.management' => 'required|exists:MA_Gerencias,ID',
            'callCenterTicket.zone' => 'required|exists:MA_TipoSucursal,ID',
            'callCenterTicket.department' => "required|exists:MA_Sucursales,ID,GerenciaID,{$this->callCenterTicket->management}",
            'callCenterTicket.detail' => 'required',
            'file' => 'nullable|mimes:jpg,png,xls,xlsx,doc,pdf,docx|max:5000',
            'agent' => 'required'
        ];
    }


    protected $messages = [
        'callCenterTicket.title.required' => 'Este campo es obligatorio',
        'callCenterTicket.priority.required' => 'El campo Prioridad, es obligatorio',
        'callCenterTicket.category.required' => 'El campo Categoría, es obligatorio',
        'callCenterTicket.category.exists' => 'La Categoría, no es valida',
        'callCenterTicket.subCategory.required' => 'El campo Sub Categoría, es obligatorio',
        'callCenterTicket.subCategory.exists' => 'La Sub Categoría, no es valida',
        'callCenterTicket.management.required' => 'El campo Marca - Gerencia, es obligatorio',
        'callCenterTicket.management.exists' => 'La Marca - Gerencia, no es valida',
        'callCenterTicket.zone.required' => 'El campo Area de Negocio, es obligatorio',
        'callCenterTicket.zone.exists' => 'La Area de Negocio, no es valida',
        'callCenterTicket.department.required' => 'El campo Sucursal - Taller - Departamento, es obligatorio',
        'callCenterTicket.department.exists' => 'La Sucursal - Taller - Departamento, no es valida',
        'callCenterTicket.detail.required' => 'El campo Descripción, es obligatorio',
        'file.mimes' => 'El archivo debe ser un archivo de tipo: jpg, png, xls, xlsx, doc, pdf, docx.',
        'file.max' => 'El tamaño maximo del archivo es 5mb',
        'agent.required' => 'La Sub Categoría, no tienen agente asignado, favor solicitar a un administrador',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->callCenterTicket = new CallCenterTicket();
        $this->businessAreas = array();
        $this->branches = array();
        $this->subCategories = array();


        $this->total = countTicketCallCenter()->get();
    }

    public function updatedCallCenterTicketManagement( $value )
    {
        return $this->businessAreas = $this->workplace->businessAreas($value)->toArray();
    }

    public function updatedCallCenterTicketZone( $value )
    {
        return $this->branches = $this->workplace->branches( $this->callCenterTicket->management,  $value )->toArray();
    }

    public function updatedCallCenterTicketCategory($value)
    {
        return $this->subCategories = CallCenterSubCategory::where('category_id', $value)->get()->toArray();
    }

    public function submit()
    {
        $this->getAgent();

        $this->validate();

        DB::transaction(function () {
            $this->callCenterTicket->applicant = auth()->user()->ID;
            $this->callCenterTicket->assigned = $this->agent;
            $this->callCenterTicket->state = 1;
            $this->callCenterTicket->FechaCreacion = date('Y-m-d ');
            $this->callCenterTicket->EventoCreacionID = 129;
            $this->callCenterTicket->UsuarioCreacionID = auth()->user()->ID;

            $this->callCenterTicket->save();

            if ($this->file)
            {
                $file = new CallCenterFileTicket();
                $path = $this->file->store('public/tickets');
                $file->url = $path;
                $file->ticket_id = $this->callCenterTicket->id;
                $file->save();
            }

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 131;
            $event->UsuarioCreacionID = 3;
            $event->ReferenciaID = $this->callCenterTicket->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Ticket";
            $event->save();

            try {
                Mail::mailer('mesadeayuda')->to($this->callCenterTicket->responsible->Email)->send(new NotificationCallCenterTicket($this->callCenterTicket));
            }catch (Exception $exception){
                Log::error( "Se produjo un error al enviar correo Call: $exception");
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
        $ticket = CallCenterTicket::where('subCategory', $this->callCenterTicket->subCategory)->latest()->first();

        if($ticket !== null )
        {
            $agentNext = CallCenterAgent::where('subCategory_id', $this->callCenterTicket->subCategory)->where( 'user_id', '>', $ticket['assigned'])->orderBy('id')->first();

            $agentFirst = CallCenterAgent::where('subCategory_id', $this->callCenterTicket->subCategory)->orderBy('id')->first()->getAttribute('user_id');

            $this->agent = $agentNext !== null ? $agentNext->getAttribute('user_id') : $agentFirst;
        }else{
            $agentFirst = CallCenterAgent::where('subCategory_id', $this->callCenterTicket->subCategory)->orderBy('id')->first()->getAttribute('user_id');

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
