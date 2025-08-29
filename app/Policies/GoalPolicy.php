<?php

namespace App\Policies;

use App\Models\Goal;
use App\Models\User;

class GoalPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user, Goal $goal)
    {

        if($user->hasPermissionTo('goals.show')) return true;

        return $goal->user_id == $user->id && $goal->status_id == 1;
    }

    public function viewTransactions(User $user, Goal $goal) {

        if($user->hasPermissionTo('goal-transactions.index')) return true;

        return $goal->user_id == $user->id && $goal->status_id == 1;

    }

    public function viewTransaction(User $user, Goal $goal) {

        if($user->hasPermissionTo('goal-transactions.show')) return true;

        return $goal->user_id == $user->id && $goal->status_id == 1;

    }
}
