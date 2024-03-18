<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Notifications\MessageLandbotNotification;
use Livewire\Component;

class Notification extends Component
{

//    private string $showNewOrderNotification;

    protected function getListeners(): array
    {
        return [
            "echo-private:channel-landbot,MessageLandbotEvent" => 'notifyNewLead',
        ];
    }

    public function notifyNewLead( $message ): void
    {
        $user = User::find($message['id']);
        $user->notify(new MessageLandbotNotification('Llegando'));
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
