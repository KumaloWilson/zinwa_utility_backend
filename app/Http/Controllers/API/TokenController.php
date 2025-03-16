<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TokenResource;
use App\Models\Meter;
use App\Services\TokenService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    protected TokenService $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * Get all tokens for authenticated user
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $tokens = $this->tokenService->getUserTokens($request->user());

        return TokenResource::collection($tokens);
    }

    /**
     * Get tokens for a specific meter
     * @throws AuthorizationException
     */
    public function meterTokens(Request $request, Meter $meter): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->authorize('view', $meter);

        $tokens = $this->tokenService->getMeterTokens($meter);

        return TokenResource::collection($tokens);
    }

    /**
     * Get token details
     */
    public function show(Request $request, Meter $token): TokenResource
    {
        $this->authorize('view', $token);

        return new TokenResource($token);
    }

    /**
     * Generate a token (without payment - for testing)
     */
    public function generate(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'meter_id' => 'required|exists:meters,id',
            'units' => 'required|numeric|min:1',
        ]);

        $meter = Meter::findOrFail($request->meter_id);
        $this->authorize('update', $meter);

        $token = $this->tokenService->generateToken($request->user(), $meter, $request->units);

        return response()->json([
            'message' => 'Token generated successfully',
            'token' => new TokenResource($token)
        ], 201);
    }

    /**
     * Verify a token
     */
    public function verify(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'token_number' => 'required|string',
        ]);

        $token = $this->tokenService->verifyToken($request->token_number);

        if ($token) {
            return response()->json([
                'message' => 'Token is valid',
                'token' => new TokenResource($token)
            ]);
        }

        return response()->json([
            'message' => 'Invalid token'
        ], 400);
    }
}

