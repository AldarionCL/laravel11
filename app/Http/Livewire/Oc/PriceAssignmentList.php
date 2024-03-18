<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcQuoteGenerator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PriceAssignmentList extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        $this->authorize( 'create', new OcQuoteGenerator );
        return view('livewire.oc.price-assignment-list');
    }
}
