<?php

namespace App\Services;

use App\Models\Meter;
use App\Models\Token;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TokenService
{
    protected TariffService $tariffService;
    protected NotificationService $notificationService;

    public function __construct(TariffService $tariffService, NotificationService $notificationService)
    {
        $this->tariffService = $tariffService;
        $this->notificationService = $notificationService;
    }

    /**
     * Get tokens for a user
     */
    public function getUserTokens(User $user): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $user->tokens()->orderBy('created_at', 'desc')->paginate(15);
    }

    /**
     * Get tokens for a meter
     */
    public function getMeterTokens(Meter $meter): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $meter->tokens()->orderBy('created_at', 'desc')->paginate(15);
    }

    /**
     * Generate a token
     * @throws \Exception
     */
    public function generateToken(User $user, Meter $meter, $units, Transaction $transaction = null)
    {
        // Calculate amount based on tariff
        $priceCalculation = $this->tariffService->calculatePrice($units);
        $amount = $priceCalculation['total_amount'];

        // If no transaction provided, create a dummy one for testing
        if (!$transaction) {
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'meter_id' => $meter->id,
                'reference' => 'TEST-' . Str::random(10),
                'amount' => $amount,
                'payment_method' => 'test',
                'status' => 'completed',
                'currency' => 'USD',
                'description' => 'Test token generation',
                'completed_at' => now(),
            ]);
        }

        // Generate a unique token number (in a real app, this would follow STS standards)
        $tokenNumber = $this->generateUniqueTokenNumber();

        // Create the token
        $token = Token::create([
            'user_id' => $user->id,
            'meter_id' => $meter->id,
            'transaction_id' => $transaction->id,
            'token_number' => $tokenNumber,
            'units' => $units,
            'amount' => $amount,
            'status' => 'active',
            'generated_at' => now(),
            'expires_at' => now()->addDays(30), // Tokens expire after 30 days if not used
        ]);

        // Send notification
        $this->notificationService->sendTokenGeneratedNotification($user, $token);

        return $token;
    }

    /**
     * Verify a token
     */
    public function verifyToken($tokenNumber)
    {
        $token = Token::where('token_number', $tokenNumber)->first();

        if (!$token) {
            return null;
        }

        // Check if token is already used
        if ($token->isUsed()) {
            return null;
        }

        // Check if token is expired
        if ($token->isExpired()) {
            return null;
        }

        return $token;
    }

    /**
     * Use a token
     */
    public function useToken(Token $token): Token
    {
        // Mark token as used
        $token->status = 'used';
        $token->used_at = now();
        $token->save();

        // Record consumption
        // In a real app, this would interact with the meter hardware

        return $token;
    }

    /**
     * Generate a unique token number
     */
    private function generateUniqueTokenNumber(): string
    {
        // In a real app, this would follow STS standards
        // For now, generate a random 20-digit number
        $tokenNumber = '';
        for ($i = 0; $i < 20; $i++) {
            $tokenNumber .= mt_rand(0, 9);
        }

        // Ensure it's unique
        if (Token::where('token_number', $tokenNumber)->exists()) {
            return $this->generateUniqueTokenNumber();
        }

        return $tokenNumber;
    }
}

