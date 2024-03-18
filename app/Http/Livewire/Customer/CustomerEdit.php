<?php

namespace App\Http\Livewire\Customer;

use App\Models\Roma\Commune;
use App\Models\Roma\Region;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use App\Models\Customer;

class CustomerEdit extends Component
{
    public Customer $customer;
    public array $communes;
    public array $regions;

    public function mount(Customer $customer): void
    {
        $this->customer = $customer;
        $this->communes = Commune::select('Comuna', 'ID')->get()->toArray();
        $this->regions = Region::select('Region', 'ID')->get()->toArray();
    }

    public function render(): Renderable
    {
        return view('livewire.customer.customer-edit');
    }

    public function rules(): array
    {
        return [
            'customer.Nombre' => ['required'],
            'customer.Rut' => ['required'],
            'customer.Email' => ['required'],
            'customer.Telefono' => ['required'],
            'customer.FechaNacimiento' => ['required'],
            'customer.Direccion' => ['required'],
            'customer.ComunaID' => ['required'],
            'customer.RegionID' => ['required'],
            'customer.EstadoCivilID' => ['required'],
            'customer.ProfesionID' => ['required']
        ];
    }
}
