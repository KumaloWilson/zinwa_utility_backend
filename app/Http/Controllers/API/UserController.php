<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get user profile
     */
    public function profile(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    /**
     * Update user profile
     */
    public function updateProfile(UpdateProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->userService->updateProfile($request->user(), $request->validated());

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Change user password
     */
    public function changePassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $result = $this->userService->changePassword(
            $request->user(),
            $request->current_password,
            $request->password
        );

        if ($result) {
            return response()->json([
                'message' => 'Password changed successfully'
            ]);
        }

        return response()->json([
            'message' => 'Current password is incorrect'
        ], 400);
    }
}

