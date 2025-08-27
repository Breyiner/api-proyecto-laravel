<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user, Transaction $transaction)
    {

        if($user->hasPermissionTo('transactions.show')) return true;

        return $transaction->user_id == $user->id;
    }
}
