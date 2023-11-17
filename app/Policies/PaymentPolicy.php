<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

     /**
     * Determine if all payments can be viewed by the user.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if the given payment can be viewed by the user.
     */
    public function view(User $user, Payment $payment): bool
    {
        return $user->is_admin ;
    }


     /**
     * Determine if the given payment can be created by the user.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if the given payment can be updated by the user.
     */
    public function update(User $user, payment $payment): bool
    {
       return $user->is_admin;
    }

    /**
     * Determine if the given payment can be deleted by the user.
     */
    public function delete(User $user, payment $payment): bool
    {
        return $user->is_admin;
    }


}
