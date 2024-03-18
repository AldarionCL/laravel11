<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class OcConfig extends Component
{
    use AuthorizesRequests;
    public function render()
    {
        $this->authorize('view', new OcCategory);

        return view('livewire.oc.oc-config');
    }
}
