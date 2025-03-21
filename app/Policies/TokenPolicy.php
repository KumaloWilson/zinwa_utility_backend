<?php

namespace App\Policies;

use App\Models\Meter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TokenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Meter $token): bool
    {
        return $user->isAdmin() || $token->user_id === $user->id;
    }
}

