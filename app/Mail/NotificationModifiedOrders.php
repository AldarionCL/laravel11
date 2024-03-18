<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationModifiedOrders extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $orderId;
    public $modifiedProducts;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $name, $orderId, $modifiedProducts, $subject)
    {
        $this->name = $name;
        $this->orderId = $orderId;
        $this->modifiedProducts = $modifiedProducts;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('roma@mailpompeyo.cl' )
            ->subject( $this->subject )
            ->with([
                'order_request_id' => $this->orderId,
                'name' => $this->name,
                'products' => $this->modifiedProducts,
            ])
            ->markdown('emails.sp-oc.modified-sp-oc');
    }
}
