<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Register a new user
     */
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role' => 'consumer', // Default role
        ]);

        // Send email verification notification
        $user->sendEmailVerificationNotification();

        return $user;
    }

    /**
     * Login user
     * @throws ValidationException
     */
    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                'email' => ['Your account is not active. Please contact support.'],
            ]);
        }

        // Update last login info
        $user->last_login_at = now();
        $user->last_login_ip = request()->ip();
        $user->save();

        return $user;
    }

    /**
     * Verify email
     */
    public function verifyEmail($userId, $hash): bool
    {
        $user = User::findOrFail($userId);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return false;
        }

        if ($user->hasVerifiedEmail()) {
            return true;
        }

        $user->markEmailAsVerified();

        return true;
    }

    /**
     * Send phone verification code
     */
    public function sendPhoneVerificationCode(User $user, $phone): true
    {
        // Update phone if different
        if ($user->phone !== $phone) {
            $user->phone = $phone;
            $user->phone_verified_at = null;
            $user->save();
        }

        // Generate a random 6-digit code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store the code in cache with expiration
        cache()->put('phone_verification:' . $user->id, $code, now()->addMinutes(15));

        // In a real app, you would send this via SMS
        // For now, we'll just log it
        Log::info('Phone verification code for user ' . $user->id . ': ' . $code);

        return true;
    }

    /**
     * Verify phone with OTP
     */
    public function verifyPhone(User $user, $code): bool
    {
        $cachedCode = cache()->get('phone_verification:' . $user->id);

        if (!$cachedCode || $cachedCode !== $code) {
            return false;
        }

        $user->phone_verified_at = now();
        $user->save();

        // Clear the code from cache
        cache()->forget('phone_verification:' . $user->id);

        return true;
    }
}

