<?php

namespace App\Policies;

use App\Models\OrderRequest\OcProduct;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OcProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderRequest\OcProduct  $ocProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OcProduct $ocProduct)
    {
        return auth()->user()->sucursales->whereIn('ID', [ 66, 146, 147, 148, 149, 150, 151, 154, 157, 234, 236, 237, 239, 240 ])->isNotEmpty();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderRequest\OcProduct  $ocProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OcProduct $ocProduct)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderRequest\OcProduct  $ocProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OcProduct $ocProduct)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderRequest\OcProduct  $ocProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OcProduct $ocProduct)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderRequest\OcProduct  $ocProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OcProduct $ocProduct)
    {
        //
    }
}
