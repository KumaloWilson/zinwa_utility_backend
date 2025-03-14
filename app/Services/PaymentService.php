<?php

namespace App\Services;

use App\Models\Meter;
use App\Models\Token;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentService
{
    protected TariffService $tariffService;
    protected TokenService $tokenService;
    protected NotificationService $notificationService;

    public function __construct(
        TariffService $tariffService,
        TokenService $tokenService,
        NotificationService $notificationService
    ) {
        $this->tariffService = $tariffService;
        $this->tokenService = $tokenService;
        $this->notificationService = $notificationService;
    }

    /**
     * Get transactions for a user
     */
    public function getUserTransactions(User $user): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $user->transactions()->orderBy('created_at', 'desc')->paginate(15);
    }

    /**
     * Initiate a payment
     * @throws \Exception
     */
    public function initiatePayment(User $user, Meter $meter, $units, $paymentMethod, $paymentProvider = null): array
    {
        // Calculate amount based on tariff
        $priceCalculation = $this->tariffService->calculatePrice($units);
        $amount = $priceCalculation['total_amount'];

        // Create a transaction record
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'meter_id' => $meter->id,
            'reference' => $this->generateTransactionReference(),
            'amount' => $amount,
            'payment_method' => $paymentMethod,
            'payment_provider' => $paymentProvider,
            'status' => 'pending',
            'currency' => 'USD',
            'description' => "Purchase of $units units for meter {$meter->meter_number}",
        ]);

        // For cash payments, mark as completed immediately
        if ($paymentMethod === 'cash') {
            $transaction->status = 'completed';
            $transaction->completed_at = now();
            $transaction->save();

            // Generate token
            $token = $this->tokenService->generateToken($user, $meter, $units, $transaction);

            return [
                'success' => true,
                'transaction' => $transaction,
                'token' => $token,
            ];
        }

        // For other payment methods, integrate with payment gateway
        // In a real app, you would redirect to payment gateway or return payment URL
        $paymentUrl = $this->getPaymentGatewayUrl($transaction, $paymentMethod, $paymentProvider);

        return [
            'success' => true,
            'transaction' => $transaction,
            'payment_url' => $paymentUrl,
        ];
    }

    /**
     * Verify a payment
     * @throws \Exception
     */
    public function verifyPayment($reference): array
    {
        $transaction = Transaction::where('reference', $reference)->first();

        if (!$transaction) {
            return [
                'success' => false,
                'message' => 'Transaction not found',
            ];
        }

        // If already completed, return success
        if ($transaction->isCompleted()) {
            $token = $transaction->token;

            return [
                'success' => true,
                'transaction' => $transaction,
                'token' => $token,
            ];
        }

        // In a real app, you would check with payment gateway
        // For now, simulate a successful payment
        $transaction->status = 'completed';
        $transaction->completed_at = now();
        $transaction->save();

        // Generate token
        $token = $this->tokenService->generateToken(
            $transaction->user,
            $transaction->meter,
            $transaction->amount / $this->tariffService->getUnitPrice(),
            $transaction
        );

        // Send notification
        $this->notificationService->sendPaymentCompletedNotification($transaction->user, $transaction);

        return [
            'success' => true,
            'transaction' => $transaction,
            'token' => $token,
        ];
    }

    /**
     * Handle payment webhook
     */
    public function handleWebhook(array $data): array
    {
        // In a real app, you would validate the webhook signature

        try {
            // Extract transaction reference from webhook data
            $reference = $data['reference'] ?? null;

            if (!$reference) {
                return [
                    'success' => false,
                    'message' => 'Transaction reference not found in webhook data',
                ];
            }

            // Find the transaction
            $transaction = Transaction::where('reference', $reference)->first();

            if (!$transaction) {
                return [
                    'success' => false,
                    'message' => 'Transaction not found',
                ];
            }

            // Update transaction status based on webhook data
            $status = $data['status'] ?? null;

            if ($status === 'successful' || $status === 'completed') {
                // Mark transaction as completed
                $transaction->status = 'completed';
                $transaction->completed_at = now();
                $transaction->save();

                // Generate token if not already generated
                if (!$transaction->token) {
                    $token = $this->tokenService->generateToken(
                        $transaction->user,
                        $transaction->meter,
                        $transaction->amount / $this->tariffService->getUnitPrice(),
                        $transaction
                    );
                }

                // Send notification
                $this->notificationService->sendPaymentCompletedNotification($transaction->user, $transaction);
            } elseif ($status === 'failed') {
                // Mark transaction as failed
                $transaction->status = 'failed';
                $transaction->save();

                // Send notification
                $this->notificationService->sendPaymentFailedNotification($transaction->user, $transaction);
            }

            return [
                'success' => true,
                'transaction' => $transaction,
            ];
        } catch (\Exception $e) {
            Log::error('Webhook processing failed: ' . $e->getMessage(), [
                'data' => $data,
            ]);

            return [
                'success' => false,
                'message' => 'Error processing webhook: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Generate a unique transaction reference
     */
    private function generateTransactionReference(): string
    {
        $prefix = 'TXN-';
        $reference = $prefix . Str::random(10);

        // Ensure it's unique
        if (Transaction::where('reference', $reference)->exists()) {
            return $this->generateTransactionReference();
        }

        return $reference;
    }

    /**
     * Get payment gateway URL
     */
    private function getPaymentGatewayUrl(Transaction $transaction, $paymentMethod, $paymentProvider)
    {
        // In a real app, you would integrate with payment gateway
        // For now, return a dummy URL
        return url("/api/payments/simulate/{$transaction->reference}");
    }
}

