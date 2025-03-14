<?php

namespace App\Services;

use App\Models\Token;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Get notifications for a user
     */
    public function getUserNotifications(User $user): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $user->userNotifications()
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(UserNotification $notification): UserNotification
    {
        $notification->markAsRead();
        return $notification;
    }

    /**
     * Mark all notifications as read for a user
     */
    public function markAllAsRead(User $user): void
    {
        $user->userNotifications()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    /**
     * Send payment completed notification
     */
    public function sendPaymentCompletedNotification(User $user, Transaction $transaction)
    {
        $notification = UserNotification::create([
            'user_id' => $user->id,
            'title' => 'Payment Successful',
            'message' => "Your payment of {$transaction->currency} {$transaction->amount} has been completed successfully.",
            'type' => 'payment',
            'data' => [
                'transaction_id' => $transaction->id,
                'reference' => $transaction->reference,
                'amount' => $transaction->amount,
                'currency' => $transaction->currency,
            ],
        ]);

        // In a real app, you would send email/SMS/push notification
        $this->sendNotificationToUser($user, $notification);

        return $notification;
    }

    /**
     * Send payment failed notification
     */
    public function sendPaymentFailedNotification(User $user, Transaction $transaction)
    {
        $notification = UserNotification::create([
            'user_id' => $user->id,
            'title' => 'Payment Failed',
            'message' => "Your payment of {$transaction->currency} {$transaction->amount} has failed. Please try again.",
            'type' => 'payment',
            'data' => [
                'transaction_id' => $transaction->id,
                'reference' => $transaction->reference,
                'amount' => $transaction->amount,
                'currency' => $transaction->currency,
            ],
        ]);

        // In a real app, you would send email/SMS/push notification
        $this->sendNotificationToUser($user, $notification);

        return $notification;
    }

    /**
     * Send token generated notification
     */
    public function sendTokenGeneratedNotification(User $user, Token $token)
    {
        $notification = UserNotification::create([
            'user_id' => $user->id,
            'title' => 'Token Generated',
            'message' => "Your token for {$token->units} units has been generated successfully. Token: {$token->token_number}",
            'type' => 'token',
            'data' => [
                'token_id' => $token->id,
                'token_number' => $token->token_number,
                'units' => $token->units,
                'meter_id' => $token->meter_id,
                'meter_number' => $token->meter->meter_number,
            ],
        ]);

        // In a real app, you would send email/SMS/push notification
        $this->sendNotificationToUser($user, $notification);

        return $notification;
    }

    /**
     * Send low balance notification
     */
    public function sendLowBalanceNotification(User $user, $meterNumber, $remainingUnits)
    {
        $notification = UserNotification::create([
            'user_id' => $user->id,
            'title' => 'Low Balance Alert',
            'message' => "Your meter {$meterNumber} has only {$remainingUnits} units remaining. Please purchase more units to avoid disconnection.",
            'type' => 'meter',
            'data' => [
                'meter_number' => $meterNumber,
                'remaining_units' => $remainingUnits,
            ],
        ]);

        // In a real app, you would send email/SMS/push notification
        $this->sendNotificationToUser($user, $notification);

        return $notification;
    }

    /**
     * Send notification to user via email/SMS/push
     */
    private function sendNotificationToUser(User $user, UserNotification $notification): void
    {
        // In a real app, you would integrate with email/SMS/push notification services
        // For now, just log the notification
        Log::info('Notification sent to user ' . $user->id, [
            'notification_id' => $notification->id,
            'title' => $notification->title,
            'message' => $notification->message,
        ]);
    }
}

