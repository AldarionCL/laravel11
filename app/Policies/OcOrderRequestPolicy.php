<?php

namespace App\Policies;

use App\Http\Utils\ProcessOrderRequest;
use App\Models\OrderRequest\OcOrderRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OcOrderRequestPolicy
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
        return auth()->user()->quoteGenerator()->exists();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderRequest\OcOrderRequest  $ocOrderRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OcOrderRequest $ocOrderRequest)
    {

        $data = $user->authorizationRequestForOrders( [ 1, 2 ] )->get()->collect() ;

        $branch = collect( $data[0]['sucursales'] );

        return /*$branch->isNotEmpty() && */ auth()->user()->buyer()->exists() || auth()->user()->approver()->exists() ;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $data = $user->authorizationRequestForOrders( [ 1, 2, 3 ] )->get()->collect() ;

        $branch = collect( $data[0]['sucursales'] );

        return auth()->user()->buyer()->exists() || auth()->user()->approver()->exists() ;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderRequest\OcOrderRequest  $ocOrderRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OcOrderRequest $ocOrderRequest)
    {
        return ProcessOrderRequest::updatePermissionOrderRequest( $ocOrderRequest, 1 );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderRequest\OcOrderRequest  $ocOrderRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OcOrderRequest $ocOrderRequest)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderRequest\OcOrderRequest  $ocOrderRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OcOrderRequest $ocOrderRequest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrderRequest\OcOrderRequest  $ocOrderRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OcOrderRequest $ocOrderRequest)
    {
        //
    }
}
