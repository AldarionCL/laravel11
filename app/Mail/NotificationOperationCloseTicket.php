<?php

namespace App\Mail;

use App\Models\OperationTicket\OperationComment;
use App\Models\OperationTicket\OperationTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationOperationCloseTicket extends Mailable
{
    use Queueable, SerializesModels;

    protected OperationTicket $ticket;
    protected OperationComment $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OperationTicket $ticket, OperationComment $comment)
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
