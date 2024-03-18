<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ApprovalRendition extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $id;
    public $subject;
    public $message;
    public $details;
    public $comment;

    public function __construct($name, $id, $subject, $message, $details, $comment = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->subject = $subject;
        $this->message = $message;
        $this->details = $details;

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
            ->subject($this->subject)
            ->markdown('emails.cash.approval');
    }
}
