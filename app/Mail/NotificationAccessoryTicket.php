<?php

namespace App\Mail;

use App\Models\AccessoryTicket\AccessoryTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class NotificationAccessoryTicket extends Mailable
{
    use Queueable, SerializesModels;

    protected AccessoryTicket $accessoryTicket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AccessoryTicket $accessoryTicket)
    {
        $this->accessoryTicket = $accessoryTicket;
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
            ->cc($this->accessoryTicket->recorder->Email)
            ->subject('Ticket Ingresado')
            ->with([
                'ticket_id' => $this->accessoryTicket->id,
                'ticket_applicant' => $this->accessoryTicket->recorder->Nombre,
                'ticket_assigned' => $this->accessoryTicket->responsible->Nombre,
                'ticket_message' => $this->accessoryTicket->detail
                /*'ticket_url' => 'https://apps.pompeyo.cl/detail-ticket/' . $this->ticket->id*/
            ])
            ->markdown('emails.ticket.notification');
        if (isset($this->accessoryTicket->file->url)) {
            $email->attachFromStorage($this->accessoryTicket->file->url);
        }

        return $email;
    }
}
