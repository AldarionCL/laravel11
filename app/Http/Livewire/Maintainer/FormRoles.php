<?php

namespace App\Http\Livewire\Maintainer;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class FormRoles extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.maintainer.form-roles');
    }

    protected $rules = [
        'name' => [ 'required', 'unique:roles,name']
    ];

    protected $messages = [
        'name.required' => 'El campo Rol es obligatorio',
        'name.unique' => 'El Rol ya existe, favor de verificar'
    ];


    public function submit()
    {
        $this->validate();

        Role::create(['name' => $this->name ]);

        $this->alertSuccess('success', 'El Rol fue guardado exitosamente');

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
