<?php

namespace App\Http\Livewire\Ticket;

use App\Http\Utils\TicketByCargo;
use App\Http\Utils\Workplace;
use App\Mail\NotificationTicket;
use App\Models\Roma\Brand;
use App\Models\Roma\SaveEvent;
use App\Models\Ticket\Agent;
use App\Models\Ticket\Category;
use App\Models\Ticket\FileTicket;
use App\Models\Ticket\SubCategory;
use App\Models\Ticket\Ticket;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormTicket extends Component
{
    use WithFileUploads;

    public $brands;
    public $businessAreas;
    public $branches;
    public Ticket $ticket;
    public $categories;
    public $subCategories;
    public $identificador;
    public $file;
    public $agent;
    public $total;
    public $location;

    public $priority = [ 'Baja', 'Normal', 'Alta'  ];

    protected $ticketByCargo;

    public function render() : Renderable
    {
        $this->brands = $this->workplace->brands()->toArray();

/*        $this->brands = Brand::all()->toArray();*/

        $this->categories = Category::all()->toArray();

        return view('livewire.tickets.form-ticket', [
            'brands' => $this->brands,
            'categories' => $this->categories,
            'amount' => $this->total->count() ?? 0,
            'closed' => $this->total->where('state', 3)->count(),
            'processing' => $this->total->where('state', 2)->count(),
            'open' => $this->total->where('state', 1)->count(),
        ]);
    }

    public function rules () {
        return [
            'ticket.title' => 'required|max:100',
/*            'ticket.priority' => 'required',*/
            'ticket.category' => 'required|exists:TK_categories,id',
            'ticket.subCategory' => "required|exists:TK_sub_categories,id,category_id,{$this->ticket->category}",
            'ticket.management' => 'required|exists:MA_Gerencias,ID',
            'ticket.zone' => 'required|exists:MA_TipoSucursal,ID',
            'ticket.department' => "required|exists:MA_Sucursales,ID,GerenciaID,{$this->ticket->management}",
            'ticket.detail' => 'required',
            'file' => 'nullable|mimes:jpg,png,xls,xlsx,doc,pdf,docx|max:5000',
            'agent' => 'required'
        ];
    }


    protected $messages = [
        'ticket.title.required' => 'Este campo es obligatorio',
        'ticket.title.max' => 'El titulo debe ser de máximo 100 cáracteres',
/*        'ticket.priority.required' => 'El campo Prioridad, es obligatorio',*/
        'ticket.category.required' => 'El campo Categoría, es obligatorio',
        'ticket.category.exists' => 'La Categoría, no es valida',
        'ticket.subCategory.required' => 'El campo Sub Categoría, es obligatorio',
        'ticket.subCategory.exists' => 'La Sub Categoría, no es valida',
        'ticket.management.required' => 'El campo Marca - Gerencia, es obligatorio',
        'ticket.management.exists' => 'La Marca - Gerencia, no es valida',
        'ticket.zone.required' => 'El campo Area de Negocio, es obligatorio',
        'ticket.zone.exists' => 'La Area de Negocio, no es valida',
        'ticket.department.required' => 'El campo Sucursal - Taller - Departamento, es obligatorio',
        'ticket.department.exists' => 'La Sucursal - Taller - Departamento, no es valida',
        'ticket.detail.required' => 'El campo Descripción, es obligatorio',
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
        $this->ticket = new Ticket();
        $this->businessAreas = array();
        $this->branches = array();
        $this->subCategories = array();
        $ticketByCargo = new TicketByCargo();
        $this->ticketByCargo =  $ticketByCargo->builder();

        $this->total = $this->ticketByCargo->get();
    }

    public function getWorkplaceProperty(): Workplace
    {
        return new Workplace(2);
    }

    public function updatedTicketManagement( $value )
    {
        return $this->businessAreas = $this->workplace->businessAreas($value)->toArray();

    }

    public function updatedTicketZone( $value )
    {
        return $this->branches = $this->workplace->branches( $this->ticket->management,  $value )->toArray();
    }

    public function updatedTicketCategory($value)
    {
        return $this->subCategories = SubCategory::where('category_id', $value)->get()->toArray();
    }

    public function updatedTicketSubcategory( $value ): void
    {
        $agent = SubCategory::where('id', $value )->has('agents')->exists();
        if (!$agent)
            $this->alertSuccess('error', 'Sub Catwgoria sin agente asignado');
    }

    public function submit()
    {
        try {
            $this->getAgent();

            $this->validate();

            DB::transaction(function () {
                $subcategoria = SubCategory::find($this->ticket->subCategory);
                $this->ticket->applicant = auth()->user()->ID;
                $this->ticket->assigned = $this->agent;
                $this->ticket->state = 1;
                $this->ticket->FechaCreacion = date('Y-m-d ');
                $this->ticket->EventoCreacionID = 129;
                $this->ticket->UsuarioCreacionID = auth()->user()->ID;
                $this->ticket->priority = $subcategoria->Prioridad;
                $this->ticket->identificador = $this->identificador;

                $this->ticket->save();

                if ($this->file)
                {
                    $file = new FileTicket();
                    $path = $this->file->store('public/tickets');
                    $file->url = $path;
                    $file->ticket_id = $this->ticket->id;
                    $file->save();
                }

                $event = new SaveEvent();
                $event->FechaCreacion = date('Y-m-d H:i:s');
                $event->EventoCreacionID = 131;
                $event->UsuarioCreacionID = 3;
                $event->ReferenciaID = $this->ticket->id;
                $event->MenuSecundarioID = 94;
                $event->Comentario = "Ingreso de Ticket";
                $event->save();

                try {
                    Mail::mailer('mesadeayuda')->to($this->ticket->responsible->Email)->send(new NotificationTicket($this->ticket));
                }catch (Exception $exception){
                    Log::error( "Se produjo un error al enviar correo Ticket: $exception");
                }
            });

            $this->ticket = new Ticket();

            $this->emit('refreshDatatable');
            $this->alertSuccess( 'success','Ticket guardado');
        }catch (\Mockery\Exception $exception){
            dd($exception->getMessage());
        }

    }

    /**
     * @return void
     */
    public function getAgent(): void
    {
        $ticket = Ticket::where('subCategory', $this->ticket->subCategory)->latest()->first();

        if($ticket !== null )
        {
            $agentNext = Agent::where('subCategory_id', $this->ticket->subCategory)->where( 'user_id', '>', $ticket['assigned'])->orderBy('id')->first();

            $agentFirst = Agent::where('subCategory_id', $this->ticket->subCategory)->orderBy('user_id', 'ASC')->first()->getAttribute('user_id');

            $this->agent = $agentNext !== null ? $agentNext->getAttribute('user_id') : $agentFirst;
        }else{
            // TODO getAttribute user 1267 1276
            $agentFirst = Agent::where('subCategory_id', $this->ticket->subCategory)->orderBy('id')->first()->getAttribute('user_id');

            $this->agent = $agentFirst;
        }

        // TODO revisar funcion
    }

    public function alertSuccess( $type, $message ): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }
}

