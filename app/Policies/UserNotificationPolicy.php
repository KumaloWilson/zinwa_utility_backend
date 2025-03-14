<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserNotificationPolicy
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
    public function view(User $user, UserNotification $notification): bool
    {
        return $user->isAdmin() || $notification->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserNotification $notification): bool
    {
        return $notification->user_id === $user->id;
    }
}

