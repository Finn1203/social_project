<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NotificationService;

class UserController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function markNotificationComplete(Request $request, $id)
    {
        $user = $request->user();
        $success = $this->notificationService->markNotificationComplete($user, $id);

        if ($success) {
            return response()->json([
                'message' => 'Notification marked as complete successfully.',
            ]);
        } else {
            return response()->json([
                'message' => 'Notification not found.',
            ], 404);
        }
    }

    public function markAllNotificationComplete(Request $request)
    {
        $user = $request->user();
        $this->notificationService->markAllNotificationsComplete($user);

        return response()->json([
            'message' => 'All notifications marked as complete successfully.',
        ]);
    }
}
