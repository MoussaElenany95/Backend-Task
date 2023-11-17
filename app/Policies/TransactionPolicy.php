<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if all transactions can be viewed by the user.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if the given transaction can be viewed by the user.
     */
    public function view(User $user, Transaction $transaction): bool
    {
        return $user->is_admin || $user->id === $transaction->payer;
    }


     /**
     * Determine if the given transaction can be created by the user.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if the given transaction can be updated by the user.
     */
    public function update(User $user, Transaction $transaction): bool
    {
       return $user->is_admin;
    }

    /**
     * Determine if the given transaction can be deleted by the user.
     */
    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->is_admin;
    }



}
