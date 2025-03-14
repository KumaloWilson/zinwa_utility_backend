<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Update user profile
     */
    public function updateProfile(User $user, array $data): User
    {
        $user->fill($data);

        // If email changed, require re-verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            // Send verification email
            $user->sendEmailVerificationNotification();
        }

        // If phone changed, require re-verification
        if ($user->isDirty('phone')) {
            $user->phone_verified_at = null;
        }

        $user->save();

        return $user;
    }

    /**
     * Change user password
     */
    public function changePassword(User $user, $currentPassword, $newPassword): bool
    {
        if (!Hash::check($currentPassword, $user->password)) {
            return false;
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return true;
    }
}

