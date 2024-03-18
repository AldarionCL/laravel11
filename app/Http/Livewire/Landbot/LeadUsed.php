<?php

namespace App\Http\Livewire\Landbot;

use Livewire\Component;

class LeadUsed extends Component
{
    public $showNewOrderNotification = "mensaje";

    protected function getListeners(): array
    {
        return [
            "echo-private:channel-landbot,MessageLandbotEvent" => 'notifyNewLead',
        ];
    }

    public function notifyNewLead(): void
    {
        $this->showNewOrderNotification = "nuevo mensaje";
        $this->emit('refreshDatatable');
    }

    public function render()
    {
        return view('livewire.landbot.lead-used');
    }
}
