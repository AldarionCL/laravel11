<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\Provider;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class ProviderEdit extends Component
{

    public Provider $provider;

    public function mount(Provider $provider): void
    {
        $this->provider = $provider;
    }

    public function render(): Renderable
    {
        return view('livewire.oc.provider-edit');
    }

    public function rules(): array
    {
        return [
            'provider.name' => ['required'],
            'provider.payment_condition' => ['required'],
            'provider.contact' => ['required'],
            'provider.address' => ['required'],
            'provider.city' => ['required'],
            'provider.postal_code' => ['required', 'numeric'],
            'provider.phone' => ['required', 'numeric'],
            'provider.email' => ['required', 'email'],
            'provider.cuenta' => ['required'],
            'provider.costCenter' => ['required'],
            'provider.gasto' => ['required'],
        ];
    }

    protected $messages = [
        'provider.name.required' => 'Este campo es requerido',
        'provider.payment_condition.required' => 'Este campo es requerido',
        'provider.contact.required' => 'Este campo es requerido',
        'provider.address.required' => 'Este campo es requerido',
        'provider.city.required' => 'Este campo es requerido',
        'provider.postal_code.required' => 'Este campo es requerido',
        'provider.postal_code.numeric' => 'Este campo es requerido',
        'provider.phone.required' => 'Este campo es requerido',
        'provider.phone.numeric' => 'Solo debe ingresar numeros',
        'provider.email.required' => 'Este campo es requerido',
        'provider.email.email' => 'Este campo debe ser una direccion de correo valida',
        'provider.cuenta.required' => 'Este campo es requerido',
        'provider.costCenter.required' => 'Este campo es requerido',
        'provider.gasto.required' => 'Este campo es requerido',
    ];

    public function submit()
    {
        $this->validate();

        $this->provider->save();

        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Proveedor editado'
        ]);
    }
}
