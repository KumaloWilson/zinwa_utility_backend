<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register a new user
     */
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->authService->register($request->validated());

        return response()->json([
            'message' => 'User registered successfully',
            'user' => new UserResource($user),
            'token' => $user->createToken('auth_token')->plainTextToken
        ], 201);
    }

    /**
     * Login user and create token
     * @throws ValidationException
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->authService->login($request->validated());

        return response()->json([
            'message' => 'Login successful',
            'user' => new UserResource($user),
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }

    /**
     * Logout user (revoke token)
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get authenticated user
     */
    public function user(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    /**
     * Verify email with token
     */
    public function verifyEmail(Request $request, $id, $hash): \Illuminate\Http\JsonResponse
    {
        $result = $this->authService->verifyEmail($id, $hash);

        if ($result) {
            return response()->json([
                'message' => 'Email verified successfully'
            ]);
        }

        return response()->json([
            'message' => 'Invalid verification link'
        ], 400);
    }

    /**
     * Send verification code to phone
     */
    public function sendPhoneVerification(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        $result = $this->authService->sendPhoneVerificationCode($request->user(), $request->phone);

        return response()->json([
            'message' => 'Verification code sent to your phone'
        ]);
    }

    /**
     * Verify phone with OTP
     */
    public function verifyPhone(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $result = $this->authService->verifyPhone($request->user(), $request->code);

        if ($result) {
            return response()->json([
                'message' => 'Phone verified successfully'
            ]);
        }

        return response()->json([
            'message' => 'Invalid verification code'
        ], 400);
    }
}

