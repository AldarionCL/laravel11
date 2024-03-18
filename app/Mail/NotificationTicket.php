<?php

namespace App\Mail;

use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationTicket extends Mailable
{
    use Queueable, SerializesModels;

    protected Ticket $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
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
            ->cc($this->ticket->recorder->Email)
            ->subject('Ticket Ingresado')
            ->with([
                'ticket_id' => $this->ticket->id,
                'ticket_applicant' => $this->ticket->recorder->Nombre,
                'ticket_assigned' => $this->ticket->responsible->Nombre,
                'ticket_message' => $this->ticket->detail
                /*'ticket_url' => 'https://apps.pompeyo.cl/detail-ticket/' . $this->ticket->id*/
            ])
            ->markdown('emails.ticket.notification');
        if (isset($this->ticket->file->url)) {
            $email->attachFromStorage($this->ticket->file->url);
        }

        return $email;
    }
}
