<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Meter;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Get all transactions for authenticated user
     */
    public function transactions(Request $request)
    {
        $transactions = $this->paymentService->getUserTransactions($request->user());
        
        return TransactionResource::collection($transactions);
    }

    /**
     * Initiate a payment
     */
    public function initiate(Request $request)
    {
        $request->validate([
            'meter_id' => 'required|exists:meters,id',
            'units' => 'required|numeric|min:1',
            'payment_method' => 'required|string|in:mobile_money,bank_transfer,card,cash',
            'payment_provider' => 'required_unless:payment_method,cash|string',
        ]);
        
        $meter = Meter::findOrFail($request->meter_id);
        $this->authorize('view', $meter);
        
        $result = $this->paymentService->initiatePayment(
            $request->user(),
            $meter,
            $request->units,
            $request->payment_method,
            $request->payment_provider
        );
        
        return response()->json([
            'message' => 'Payment initiated successfully',
            'transaction' => new TransactionResource($result['transaction']),
            'payment_url' => $result['payment_url'] ?? null,
        ]);
    }

    /**
     * Verify a payment
     */
    public function verify(Request $request, $reference)
    {
        $result = $this->paymentService->verifyPayment($reference);
        
        if ($result['success']) {
            return response()->json([
                'message' => 'Payment verified successfully',
                'transaction' => new TransactionResource($result['transaction']),
                'token' => $result['token'] ? $result['token']->token_number : null,
            ]);
        }
        
        return response()->json([
            'message' => $result['message'] ?? 'Payment verification failed'
        ], 400);
    }

    /**
     * Handle payment webhook
     */
    public function webhook(Request $request)
    {
        $result = $this->paymentService->handleWebhook($request->all());
        
        if ($result['success']) {
            return response()->json([
                'message' => 'Webhook processed successfully'
            ]);
        }
        
        return response()->json([
            'message' => $result['message'] ?? 'Failed to process webhook'
        ], 400);
    }
}

