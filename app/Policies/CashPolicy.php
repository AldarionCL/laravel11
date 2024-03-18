<?php

namespace App\Policies;

use App\Http\Utils\ProcessCash;
use App\Models\Cash\Cash;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CashPolicy
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
     * @param  \App\Models\Cash\Cash  $cash
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Cash $cash)
    {
        //
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
     * @param  \App\Models\Cash\Cash  $cash
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Cash $cash)
    {
        return ProcessCash::updatePermissionCash( $cash->id );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cash\Cash  $cash
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Cash $cash)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cash\Cash  $cash
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Cash $cash)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cash\Cash  $cash
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Cash $cash)
    {
        //
    }
}