<?php

namespace App\Http\Livewire\Accessory;

use App\Mail\NotificationAccesoryCloseTicket;
use App\Mail\NotificationAccesoryComment;
use App\Models\AccessoryTicket\AccessoryComment;
use App\Models\AccessoryTicket\AccessoryFileComment;
use App\Models\AccessoryTicket\AccessoryTicket;
use App\Models\Roma\SaveEvent;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccessoryDetailTicket extends Component
{
    use WithFileUploads;

    public AccessoryTicket $ticket;
    public AccessoryComment $comment;
    public $file;

    protected $rules = [
        'comment.detail' => 'required',
        'file' => 'nullable|mimes:jpg,png,xls,xlsx,doc,pdf,docx|max:5000',
    ];

    protected $messages = [
        'comment.detail.required' => 'Este campo es obligatorio',
        'file.mimes' => 'El archivo debe ser un archivo de tipo: jpg, png, xls, xlsx, doc, pdf, docx.',
        'file.max' => 'El tamaño maximo del archivo es 5mb',
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function mount(): void
    {
        $this->comment = new AccessoryComment();
    }
    public function render()
    {
        return view('livewire.accesory.accessory-detail-ticket');
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction( function () {

            $this->createComment();

            $this->ticket->state = 2;
            $this->ticket->save();

            if ($this->file)
            {
                $file = new AccessoryFileComment();
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
                Mail::mailer('mesadeayuda')->to(auth()->user()->Email)->send(new NotificationAccesoryComment($this->comment, $this->ticket->load('responsible', 'recorder')));
            }catch (Exception $exception){
                Log::error( "Se produjo un error al enviar correo Accesorio: $exception");
            }
        });

        $this->comment->detail = null;
        $this->file = null;

        $this->emit('refreshDatatable');
        $this->alertSuccess();
    }

    public function closeTicket( $value ): void
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
                Mail::mailer('mesadeayuda')->to( $this->ticket->recorder->Email )->send( new NotificationAccesoryCloseTicket($this->ticket, $this->comment) );
            }catch (Exception $exception){
                Log::error( "Se produjo un error al enviar correo Accesorio: $exception");
            }
        });
        $this->alertSuccess();
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
