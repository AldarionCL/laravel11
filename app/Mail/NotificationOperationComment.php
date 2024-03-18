<?php

namespace App\Mail;

use App\Models\OperationTicket\OperationComment;
use App\Models\OperationTicket\OperationTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationOperationComment extends Mailable
{
    use Queueable, SerializesModels;

    protected OperationComment $comment;
    protected OperationTicket $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OperationComment $comment, OperationTicket $ticket)
    {
        //
        $this->comment = $comment;
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this
            ->from('roma@mailpompeyo.cl')
            ->subject('Seguimiento ingresado')
            ->cc( $this->comment->recorder->ID == $this->ticket->recorder->ID ? $this->ticket->responsible->Email : $this->ticket->recorder->Email )
            ->with([
                'ticket_id' => $this->ticket->id,
                'comment_by' => auth()->user()->Nombre,
                'comment_for' => $this->comment->recorder->ID == $this->ticket->recorder->ID ? $this->ticket->responsible->Nombre : $this->ticket->recorder->Nombre,
                'comment_message' => $this->comment->detail
                /*'ticket_url' => 'https://apps.pompeyo.cl/detail-ticket/' . $this->ticket->id*/
            ])
            ->markdown('emails.comment.notification');

        if (isset($this->comment->file->url)) {
            $email->attachFromStorage($this->comment->file->url);
        }

        return $email;
    }
}
