<?php

namespace App\Policies;

use App\Models\Meter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeterPolicy
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
    public function view(User $user, Meter $meter): bool
    {
        return $user->isAdmin() || $meter->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Meter $meter): bool
    {
        return $user->isAdmin() || $meter->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Meter $meter): bool
    {
        return $user->isAdmin();
    }
}

