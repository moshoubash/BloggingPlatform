<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function notifications()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->get();
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        if ($notification->is_read == 1) {
            return redirect()->back();
        }
        $notification->is_read = 1;
        $notification->save();
        return redirect()->back();
    }
}