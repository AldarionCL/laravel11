<?php

namespace App\Http\Livewire\Operation;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class OperationTicketConfig extends Component
{
    public function render(): Renderable
    {
        return view('livewire.call-center.call-center-ticket-config');
    }
}
