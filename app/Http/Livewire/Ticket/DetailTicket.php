<?php

namespace App\Http\Livewire\Ticket;

use App\Mail\NotificationCloseTicket;
use App\Mail\NotificationComment;
use App\Models\Roma\SaveEvent;
use App\Models\Ticket\Agent;
use App\Models\Ticket\Comment;
use App\Models\Ticket\FileComment;
use App\Models\Ticket\Ticket;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailTicket extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public Comment $comment;
    public $file;

    public $arrayResponsables = [];
    public $responsable;

    protected $rules = [
        'comment.detail' => 'required',
        'file' => 'nullable|mimes:jpg,png,xls,xlsx,doc,pdf,docx|max:5000',
    ];

    protected $messages = [
        'comment.detail.required' => 'Este campo es obligatorio',
        'file.mimes' => 'El archivo debe ser un archivo de tipo: jpg, png, xls, xlsx, doc, pdf, docx.',
        'file.max' => 'El tamaño maximo del archivo es 5mb',
    ];

    protected $listeners = ['asignar' => 'asignaResponsable'];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        // obtiene la lista de assigned
        $listaResponsables = Agent::with('user')->groupBy('user_id')->get();
        foreach ($listaResponsables as $responsible)
        {
            $this->arrayResponsables[] = ["id"=>$responsible->user->ID , "name"=>$responsible->user->Nombre];
        }
        $this->responsable = $this->ticket->assigned;
        $this->comment = new Comment();
    }
    public function render()
    {
        return view('livewire.tickets.detail-ticket');
    }

    public function submit()
    {
        $this->validate();

        DB::transaction( function () {

            $this->createComment();

            $this->ticket->state = 2;
            $this->ticket->save();

            if ($this->file)
            {
                $file = new FileComment();
                $path = $this->file->store('public/tickets');
                $file->url = $path;
                $file->comment_id = $this->comment->id;
                $file->save();
            }

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 132;
            $event->UsuarioCreacionID = 3;
            $event->ReferenciaID = $this->comment->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Ingreso de Comentario";
            $event->save();

            try {
                Mail::mailer('mesadeayuda')->to(auth()->user()->Email)->send(new NotificationComment($this->comment, $this->ticket->load('responsible', 'recorder')));
            }catch (Exception $exception){
                Log::error( "Se produjo un error al enviar correo Ticket detalle: $exception");
            }
        });

        $this->comment = new Comment();
        $this->file = null;

        $this->emit('refreshDatatable');
        $this->alertSuccess();
    }

    public function closeTicket( $value )
    {
        $this->validate();

        DB::transaction( function () {

            $this->createComment();

            $this->ticket->state = 3;
            $this->ticket->FechaActualizacion = date('Y-m-d H:i:s');
            $this->ticket->EventoActualizacionID = 130;
            $this->ticket->UsuarioActualizacionID = 10;
            $this->ticket->save();

            $event = new SaveEvent();
            $event->FechaCreacion = date('Y-m-d H:i:s');
            $event->EventoCreacionID = 133;
            $event->UsuarioCreacionID = 3;
            $event->ReferenciaID = $this->ticket->id;
            $event->MenuSecundarioID = 94;
            $event->Comentario = "Cierre de Ticket";
            $event->save();

            try {
                Mail::mailer('mesadeayuda')->to( $this->ticket->recorder->Email )->send( new NotificationCloseTicket($this->ticket, $this->comment) );
            }catch (Exception $exception){
                Log::error( "Se produjo un error al enviar correo Ticket detalle: $exception");
            }

        });
        $this->alertSuccess();
    }
    public function asignaResponsable()
    {
        DB::transaction( function () {
        $this->ticket->assigned = $this->responsable;
        $this->ticket->save();
        });
        $this->alertSuccess();

        return true;
    }


    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Seguimiento guardado'
        ]);
    }

    /**
     * @return void
     */
    public function createComment(): void
    {
        $this->comment->ticket_id = $this->ticket->id;
        $this->comment->user_id = auth()->user()->ID;
        $this->comment->FechaCreacion = date('Y-m-d H:i:s');
        $this->comment->EventoCreacionID = 1;
        $this->comment->UsuarioCreacionID = auth()->user()->ID;

        $this->comment->save();
    }



}
