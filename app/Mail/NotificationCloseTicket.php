<?php

namespace App\Mail;

use App\Models\Ticket\Comment;
use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationCloseTicket extends Mailable
{
    use Queueable, SerializesModels;

    protected Ticket $ticket;
    protected Comment $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, Comment $comment)
    {
        //
        $this->ticket = $ticket;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('roma@mailpompeyo.cl')
            ->cc(auth()->user()->Email)
            ->subject('Ticket cerrado')
            ->with([
                'ticket_id' => $this->ticket->id,
                'ticket_applicant' => $this->ticket->recorder->Nombre,
                'ticket_assigned' => $this->ticket->responsible->Nombre,
                'comment_message' => $this->comment->detail
                /*'ticket_url' => 'https://flujodetrabajo.pompeyo.cl/detail-ticket/' . $this->ticket->id*/
            ])
            ->markdown('emails.ticket.notification-close');
    }
}
