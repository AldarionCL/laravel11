<?php

namespace App\Policies;

use App\Models\PurchaseOrder\OcPurchaseOrder;
use App\Models\PurchaseOrder\Receptionist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReceptionistPolicy
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
     * @param  \App\Models\PurchaseOrder\Receptionist  $receptionist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Receptionist $receptionist)
    {
        return auth()->user()->receptionist()->exists();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, OcPurchaseOrder $ocPurchaseOrder)
    {
        $data = Receptionist::where('branchOffice_id', $ocPurchaseOrder->branch_id )
            ->where('user_id', $user->ID)->count();

        return $data > 0;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PurchaseOrder\Receptionist  $receptionist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Receptionist $receptionist)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PurchaseOrder\Receptionist  $receptionist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Receptionist $receptionist)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PurchaseOrder\Receptionist  $receptionist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Receptionist $receptionist)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PurchaseOrder\Receptionist  $receptionist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Receptionist $receptionist)
    {
        //
    }
}
