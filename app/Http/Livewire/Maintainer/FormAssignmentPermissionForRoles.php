<?php

namespace App\Http\Livewire\Maintainer;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FormAssignmentPermissionForRoles extends Component
{
    public $rol;
    public $hasPermission = [];

    public function render(): Renderable
    {
        return view('livewire.maintainer.form-assignment-permission-for-roles', [
            'roles' => Role::select('id', 'name')->get()->toArray(),
            'permissions' => Permission::select('id', 'name', 'group')->get()->toArray()
        ]);
    }

    public function updatedRol( $value ): void
    {
        $this->hasPermission = [];

        $permissionsRole = Role::with('permissions:id,name')->select('id')->where('id', $value)->get()->toArray();

        foreach ($permissionsRole[0]['permissions'] as $permission) {
            $this->hasPermission[] = $permission['name'];
        }
    }

    public function submit()
    {
        $role = Role::findById($this->rol);
        $role->syncPermissions([$this->hasPermission]);

        $this->alertSuccess('success', 'Los permisos fueron asignados al Rol exitosamente');
    }

    public function alertSuccess($type, $message): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
