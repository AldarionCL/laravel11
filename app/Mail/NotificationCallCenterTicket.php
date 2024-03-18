<?php

namespace App\Mail;

use App\Models\CallCenterTicket\CallCenterTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class NotificationCallCenterTicket extends Mailable
{
    use Queueable, SerializesModels;

    protected CallCenterTicket $callCenterTicket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CallCenterTicket $callCenterTicket)
    {
        $this->callCenterTicket = $callCenterTicket;
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
            ->cc($this->callCenterTicket->recorder->Email)
            ->subject('Ticket Ingresado')
            ->with([
                'ticket_id' => $this->callCenterTicket->id,
                'ticket_applicant' => $this->callCenterTicket->recorder->Nombre,
                'ticket_assigned' => $this->callCenterTicket->responsible->Nombre,
                'ticket_message' => $this->callCenterTicket->detail
                /*'ticket_url' => 'https://apps.pompeyo.cl/detail-ticket/' . $this->ticket->id*/
            ])
            ->markdown('emails.ticket.notification');
        if (isset($this->callCenterTicket->file->url)) {
            $email->attachFromStorage($this->callCenterTicket->file->url);
        }

        return $email;
    }
}
