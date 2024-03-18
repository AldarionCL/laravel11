<?php

namespace App\Http\Livewire\Oc;

use App\Models\PurchaseOrder\Receptionist;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class OcListToReceive extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize( 'view', new Receptionist );

        return view('livewire.oc.oc-list-to-receive');
    }
}
