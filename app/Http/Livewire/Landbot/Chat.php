<?php

namespace App\Http\Livewire\Landbot;

use App\Models\Landbot\Chat as Conversation;
use App\Models\Landbot\Message;
use App\Models\Roma\MkLead;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Chat extends Component
{
    public Conversation $chat;
    public $message;
    public $conversation;

    public $showNewOrderNotification = "mensaje";

    protected function getListeners(): array
    {
        return [
            "echo-private:channel-landbot-message,SendMessageLandbotEvent" => 'notifyNewMessage',
        ];
    }

    public function notifyNewMessage(): void
    {
        $this->conversation = $this->chat->load('messages')->refresh();
    }


    public function mount()
    {
        $this->conversation = $this->chat->load('messages');
    }
    public function render()
    {
        return view('livewire.landbot.chat');
    }

    public function send( $customer_id )
    {
        $message = Message::select('created_at', 'customer_id', 'id')->where('customer_id', $customer_id )->orderBy('id', 'DESC')->limit(1)->get();

        if ( $message[0]['created_at']->addDay() > now())
        {
            $response = Http::
                contentType('text/plain')
                ->retry(3, 100)
                ->withHeaders(
                    [
                        "Authorization" => "Token 9ecaf7965ba06dd9fea1332a0a83bcfc30dfd514",
                        "Content-Type" => "application/json"
                    ]
                )
                ->post(
                    'https://api.landbot.io/v1/customers/'.$customer_id.'/send_text/',
                    [
                        "message" => $this->message
                    ]
                );

        }else
        {
            $response = Http::
                contentType('text/plain')
                ->retry(3, 100)
                ->withHeaders(
                    [
                        "Authorization" => "Token 9ecaf7965ba06dd9fea1332a0a83bcfc30dfd514",
                        "Content-Type" => "application/json"
                    ]
                )
                ->post(
                    'https://api.landbot.io/v1/customers/'.$customer_id.'/send_template/',
                    [
                        "template_id" => 3424,
                        "template_params" => [
                            "body" => [
                                "params" => []
                            ]
                        ],
                        "template_language" => "en"
                    ]
                );

        }
        if ( $response->successful() ){
            $this->alertSuccess( 'success', 'Mensaje enviado' );

            MkLead::where('ID', $this->chat->lead_id )
                ->update(['Contactado' => 1]);

        }else{
            $this->alertSuccess('warning', 'Error al enviar mensaje');
        }

        $this->message = "";

    }

    public function alertSuccess($type, $message )
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
