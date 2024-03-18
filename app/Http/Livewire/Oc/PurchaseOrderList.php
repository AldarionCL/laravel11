<?php

namespace App\Http\Livewire\Oc;

use App\Models\PurchaseOrder\Approver;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PurchaseOrderList extends Component
{
    use AuthorizesRequests;

    public function mount()
    {
        $this->authorize('create', new Approver );
    }

    public function render()
    {
        return view('livewire.oc.purchase-order-list');
    }
}
