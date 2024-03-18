<?php

use App\Http\Livewire\Maintainer\FormAssignmentBranchOfficeForUser;
use App\Http\Livewire\Maintainer\FormAssignmentPermissionForRoles;
use App\Http\Livewire\Maintainer\FormRoles;
use App\Http\Livewire\Maintainer\FormUser;
use App\Http\Livewire\Maintainer\MaintainerUser;
use App\Http\Livewire\Maintainer\MaintainerUserDetail;

Route::get('/usuarios', MaintainerUser::class)->name('maintainer.users');
Route::get('/usuarios/{user}', MaintainerUserDetail::class)->name('maintainer.users.detail');

Route::get('/formulario-roles', FormRoles::class)->name('maintainer.roles');
Route::get('/formulario-asignacion-permisos-a-roles', FormAssignmentPermissionForRoles::class)->name('maintainer.permission.for.roles');

Route::get('/formulario-de-usuarios', FormUser::class)->name('maintainer.user');

Route::get('/formulario-asignacion-sucursales-a-usuario/{user_id}', FormAssignmentBranchOfficeForUser::class)->name('maintainer.branch.for.user');
