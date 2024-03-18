<?php

namespace App\Policies;

use App\Http\Utils\ProcessOrderRequest;
use App\Models\PurchaseOrder\OcPurchaseOrder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OcPurchaseOrderPolicy
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
     * @param  \App\Models\PurchaseOrder\OcPurchaseOrder  $ocPurchaseOrder
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OcPurchaseOrder $ocPurchaseOrder)
    {
        $data = $user->authorizationRequestForOrders( [ 3 ] )->get()->collect() ;

        $branch = collect( $data[0]['sucursales'] );

        return /*$branch->isNotEmpty() &&*/ auth()->user()->purchaseOrderGenerator()->exists() || auth()->user()->approver()->exists() ;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $data = $user->authorizationRequestForOrders( [ 3 ] )->get()->collect() ;

        $branch = collect( $data[0]['sucursales'] );

        return auth()->user()->purchaseOrderGenerator()->exists() || auth()->user()->approver()->exists();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PurchaseOrder\OcPurchaseOrder  $ocPurchaseOrder
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OcPurchaseOrder $ocPurchaseOrder)
    {
        return ProcessOrderRequest::updatePermissionOrderRequest( $ocPurchaseOrder, 2 );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PurchaseOrder\OcPurchaseOrder  $ocPurchaseOrder
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OcPurchaseOrder $ocPurchaseOrder)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PurchaseOrder\OcPurchaseOrder  $ocPurchaseOrder
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OcPurchaseOrder $ocPurchaseOrder)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PurchaseOrder\OcPurchaseOrder  $ocPurchaseOrder
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OcPurchaseOrder $ocPurchaseOrder)
    {
        //
    }
}
