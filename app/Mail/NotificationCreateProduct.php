<?php

namespace App\Mail;

use FontLib\Table\Type\name;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationCreateProduct extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $name_recorder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $name_recorder)
    {

        $this->name = $name;
        $this->name_recorder = $name_recorder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('roma@mailpompeyo.cl' )
            ->subject( "Creación de Producto" )
            ->with([
                'name' => $this->name,
                'name_recorder' => $this->name_recorder
            ])
            ->markdown('emails.sp-oc.create-product-sp-oc');
    }
}
