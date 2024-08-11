<?php
namespace App\Services;

use Illuminate\Notifications\DatabaseNotification;

class NotificationService
{
    public function markNotificationComplete($user, $notificationId)
    {
        $notification = $user->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->delete();
            return true;
        }

        return false;
    }

    public function markAllNotificationsComplete($user)
    {
        $user->unreadNotifications->markAsRead();
        return true;
    }
}
