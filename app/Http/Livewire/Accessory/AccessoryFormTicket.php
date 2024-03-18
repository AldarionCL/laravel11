<?php

namespace App\Http\Livewire\Accessory;

use App\Http\Utils\Workplace;
use App\Mail\NotificationAccessoryTicket;
use App\Models\AccessoryTicket\AccessoryAgent;
use App\Models\AccessoryTicket\AccessoryCategory;
use App\Models\AccessoryTicket\AccessoryFileTicket;
use App\Models\AccessoryTicket\AccessorySubCategory;
use App\Models\AccessoryTicket\AccessoryTicket;
use App\Models\Roma\SaveEvent;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccessoryFormTicket extends Component
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
    public AccessoryTicket $accessoryTicket;

    public function getWorkplaceProperty(): Workplace
    {
        return new Workplace();
    }

    public function render(): Renderable
    {

        $this->brands = $this->workplace->brands()->toArray();

        $this->categories = AccessoryCategory::all()->toArray();

        return view('livewire.accesory.accessory-form-ticket', [
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
            'accessoryTicket.title' => 'required',
            'accessoryTicket.priority' => 'required',
            'accessoryTicket.category' => 'required|exists:TKa_categories,ID',
            'accessoryTicket.subCategory' => "required|exists:TKa_sub_categories,id,category_id,{$this->accessoryTicket->category}",
            'accessoryTicket.management' => 'required|exists:MA_Gerencias,ID',
            'accessoryTicket.zone' => 'required|exists:MA_TipoSucursal,ID',
            'accessoryTicket.department' => "required|exists:MA_Sucursales,ID,GerenciaID,{$this->accessoryTicket->management}",
            'accessoryTicket.detail' => 'required',
            'file' => 'nullable|mimes:jpg,png,xls,xlsx,doc,pdf,docx|max:5000',
            'agent' => 'required'
        ];
    }


    protected $messages = [
        'accessoryTicket.title.required' => 'Este campo es obligatorio',
        'accessoryTicket.priority.required' => 'El campo Prioridad, es obligatorio',
        'accessoryTicket.category.required' => 'El campo Categoría, es obligatorio',
        'accessoryTicket.category.exists' => 'La Categoría, no es valida',
        'accessoryTicket.subCategory.required' => 'El campo Sub Categoría, es obligatorio',
        'accessoryTicket.subCategory.exists' => 'La Sub Categoría, no es valida',
        'accessoryTicket.management.required' => 'El campo Marca - Gerencia, es obligatorio',
        'accessoryTicket.management.exists' => 'La Marca - Gerencia, no es valida',
        'accessoryTicket.zone.required' => 'El campo Area de Negocio, es obligatorio',
        'accessoryTicket.zone.exists' => 'La Area de Negocio, no es valida',
        'accessoryTicket.department.required' => 'El campo Sucursal - Taller - Departamento, es obligatorio',
        'accessoryTicket.department.exists' => 'La Sucursal - Taller - Departamento, no es valida',
        'accessoryTicket.detail.required' => 'El campo Descripción, es obligatorio',
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
        $this->accessoryTicket = new AccessoryTicket();
        $this->businessAreas = array();
        $this->branches = array();
        $this->subCategories = array();


        $this->total = countTicketAccessory()->get();
    }

    public function updatedAccessoryTicketManagement( $value )
    {
        return $this->businessAreas = $this->workplace->businessAreas($value)->toArray();
    }

    public function updatedAccessoryTicketZone( $value )
    {
        return $this->branches = $this->workplace->branches( $this->accessoryTicket->management,  $value )->toArray();
    }

    public function updatedAccessoryTicketCategory($value)
    {
        return $this->subCategories = AccessorySubCategory::where('category_id', $value)->get()->toArray();
    }

    public function updatedAccessoryTicketSubcategory( $value )
    {
        $agent = AccessorySubCategory::where('id', $value )->has('agents')->exists();
        if (!$agent)
            $this->alertSuccess('error', 'Sub Catwgoria sin agente asignado');
    }

    public function submit()
    {
        $this->getAgent();

        $this->validate();

        DB::transaction(function () {
            $this->accessoryTicket->applicant = auth()->user()->ID;
            $this->accessoryTicket->assigned = $this->agent;
            $this->accessoryTicket->state = 1;
            $this->accessoryTicket->FechaCreacion = date('Y-m-d ');
            $this->accessoryTicket->EventoCreacionID = 129;
            $this->accessoryTicket->UsuarioCreacionID = auth()->user()->ID;

            $this->accessoryTicket->save();

            if ($this->file)
            {
                $file = new AccessoryFileTicket();
                $path = $this->file->store('public/tickets');
                $file->url = $path;
                $file->ticket_id = $this->accessoryTicket->id;
                $file->save();
            }

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 131;
            $event->UsuarioCreacionID = 3;
            $event->ReferenciaID = $this->accessoryTicket->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Ticket";
            $event->save();

            try {
                Mail::mailer('mesadeayuda')->to($this->accessoryTicket->responsible->Email)->send(new NotificationAccessoryTicket($this->accessoryTicket));
            }catch (Exception $exception){
                Log::error( "Se produjo un error al enviar correo Accesorio: $exception");
            }
        });

        // $this->ticket = new Ticket();

        $this->emit('refreshDatatable');
        $this->alertSuccess('success','Ticket guardado');

    }

    /**
     * @return void
     */
    public function getAgent(): void
    {
        $ticket = AccessoryTicket::where('subCategory', $this->accessoryTicket->subCategory)->latest()->first();

        if($ticket !== null )
        {
            $agentNext = AccessoryAgent::where('subCategory_id', $this->accessoryTicket->subCategory)->where( 'user_id', '>', $ticket['assigned'])->orderBy('id')->first();

            $agentFirst = AccessoryAgent::where('subCategory_id', $this->accessoryTicket->subCategory)->orderBy('id')->first()->getAttribute('user_id');

            $this->agent = $agentNext !== null ? $agentNext->getAttribute('user_id') : $agentFirst;
        }else{
            $agentFirst = AccessoryAgent::where('subCategory_id', $this->accessoryTicket->subCategory)->orderBy('id')->first()->getAttribute('user_id');

            $this->agent = $agentFirst;
        }

    }

    public function alertSuccess( $type, $message ): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
