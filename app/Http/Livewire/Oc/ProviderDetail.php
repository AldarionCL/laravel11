<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\Provider;
use Livewire\Component;

class ProviderDetail extends Component
{
    public Provider $provider;
    public $message;

    public function mount( Provider $provider )
    {
        $this->provider = $provider;
    }

    public function render()
    {
        return view('livewire.oc.provider-detail');
    }
}
