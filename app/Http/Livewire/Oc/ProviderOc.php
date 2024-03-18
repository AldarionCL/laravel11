<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\Provider;
use App\Rules\RutUniqueTable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProviderOc extends Component
{
    public Provider $provider;

    public function rules()
    {



//        .Rut::parse( $this->provider->rut )->format(Rut::FORMAT_ESCAPED)
        return  [
            'provider.name' => [ 'required'],
            'provider.rut' => [ 'required', 'cl_rut', new RutUniqueTable ],
            'provider.payment_condition' => [ 'required'],
            'provider.contact' => [ 'required'],
            'provider.address' => [ 'required'],
            'provider.city' => [ 'required'],
            'provider.postal_code' => [ 'required', 'numeric'],
            'provider.phone' => [ 'required', 'numeric'],
            'provider.email' => [ 'required', 'email'],
            'provider.cuenta' => [ 'required'],
            'provider.costCenter' => [ 'required'],
            'provider.gasto' => [ 'required'],
        ];
    }

    protected $messages = [
        'provider.name.required' => 'Este campo es requerido',
        'provider.rut.required' => 'Este campo es requerido',
        'provider.rut.cl_rut' => 'RUT no valido',
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->provider = new Provider();
    }

    public function render()
    {
        return view('livewire.oc.provider-oc');
    }

    public function submit()
    {
        $this->validate();

        DB::transaction( function () {
            $this->provider->save();
        });

        $this->alertSuccess();
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'message' => 'Proveedor guardado'
        ]);
    }
}
