<?php

namespace App\Mail;

use App\Models\OperationTicket\OperationTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationOperationTicket extends Mailable
{
    use Queueable, SerializesModels;

    protected OperationTicket $operationTicket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(OperationTicket $operationTicket)
    {
        $this->operationTicket = $operationTicket;
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
            ->cc($this->operationTicket->recorder->Email)
            ->subject('Ticket Ingresado')
            ->with([
                'ticket_id' => $this->operationTicket->id,
                'ticket_applicant' => $this->operationTicket->recorder->Nombre,
                'ticket_assigned' => $this->operationTicket->responsible->Nombre,
                'ticket_message' => $this->operationTicket->detail
                /*'ticket_url' => 'https://apps.pompeyo.cl/detail-ticket/' . $this->ticket->id*/
            ])
            ->markdown('emails.ticket.notification');
        if (isset($this->operationTicket->file->url)) {
            $email->attachFromStorage($this->operationTicket->file->url);
        }

        return $email;
    }
}
