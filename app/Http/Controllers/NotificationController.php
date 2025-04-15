<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        // Obtener notificaciones no leídas
        $notifications = $request->user()->unreadNotifications;

        return view('notifications.index', [
            'notifications' => $notifications,
        ]);
    }

    public function markAsRead(Request $request)
    {
        // Marcar todas las notificaciones como leídas
        $request->user()->unreadNotifications->markAsRead();

        return back()->with('mensaje', 'Notificaciones marcadas como leídas');
    }
}