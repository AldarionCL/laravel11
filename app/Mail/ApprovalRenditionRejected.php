<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;


class ApprovalRenditionRejected extends Mailable
{

    public mixed $details;
    public $name;
    public $id;
    public $message;

    /**
     * @param mixed $cash
     */
    public function __construct($name, $id, $message,  $details)
    {
        $this->details = $details;
        $this->name = $name;
        $this->id = $id;
        $this->message = $message;
    }

    public function build()
    {
        return $this->from('roma@mailpompeyo.cl')
            ->subject("Items rechazados de rendición de caja chica")
            ->markdown('emails.cash.rejected');
    }
}
