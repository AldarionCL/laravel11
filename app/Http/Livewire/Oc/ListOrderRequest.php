<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcOrderRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ListOrderRequest extends Component
{
    use AuthorizesRequests;
    public function mount()
    {
        $this->authorize('view', new OcOrderRequest() );
    }

    public function render()
    {
        return view('livewire.oc.list-order-request');
    }
}
