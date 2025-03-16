<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserNotificationResource;
use App\Models\UserNotification;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Get all notifications for authenticated user
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $notifications = $this->notificationService->getUserNotifications($request->user());

        return UserNotificationResource::collection($notifications);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Request $request, UserNotification $notification): \Illuminate\Http\JsonResponse
    {
        $this->authorize('update', $notification);

        $notification = $this->notificationService->markAsRead($notification);

        return response()->json([
            'message' => 'Notification marked as read',
            'notification' => new UserNotificationResource($notification)
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->notificationService->markAllAsRead($request->user());

        return response()->json([
            'message' => 'All notifications marked as read'
        ]);
    }
}

