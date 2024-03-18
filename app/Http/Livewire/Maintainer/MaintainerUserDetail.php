<?php

namespace App\Http\Livewire\Maintainer;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MaintainerUserDetail extends Component
{
    public User $user;
    public $permissions = [];
    public array $hasPermission = [];
    public $rol;

    public function mount(): void
    {
        $permissionsUser = $this->user->load('permissions:name')->toArray()['permissions'];
        foreach ($permissionsUser as $permission) {
            $this->hasPermission[] = $permission['name'];
        }

        $this->permissions = Permission::all()->toArray();
    }

    public function render(): Renderable
    {
        return view('livewire.maintainer.maintainer-user-detail', [
            'roles' => Role::select('id', 'name')->get()->toArray(),
        ]);
    }

    public function submit(): void
    {
        DB::transaction(function () {
            $this->user->syncPermissions($this->hasPermission);
        });

        $this->alertSuccess('success', 'Permisos guardados!!!');
    }

    public function alertSuccess($type, $message): void
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => $type,
            'message' => $message
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
}
