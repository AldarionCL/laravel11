<?php

namespace App\Http\Livewire\Ti;

use App\Models\Ti\TiProduct;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class FormTiProduct extends Component
{
    public $name;

    protected $rules = [
        'name' => [ 'required', 'unique:ti_products,name']
    ];

    protected $messages = [
        'name.required' => 'Este campo es requerido',
        'name.unique' => 'Este articulo ya existe, favor de verificar'
    ];

    public function render(): Renderable
    {
        return view('livewire.ti.form-ti-product');
    }

    public function submit()
    {
        $this->validate();

        TiProduct::create([
            'name' => $this->name
        ]);

        $this->alertSuccess('success', 'Articulo creado correctamente!!!');

        $this->name = '';
    }

    public function alertSuccess($type, $message): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
