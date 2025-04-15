<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\FollowNotification;

class FollowerController extends Controller
{
    public function store(Request $request, User $user)
    {
        // Seguir al usuario
        $user->followers()->attach($request->user()->id);

        // Enviar notificación al usuario seguido
        if ($user->id !== $request->user()->id) { // Evitar notificar al usuario si se sigue a sí mismo
            $user->notify(new FollowNotification($request->user()));
        }

        return back()->with('mensaje', 'Has comenzado a seguir a ' . $user->username);
    }

    public function destroy(Request $request, User $user)
    {
        // Dejar de seguir al usuario
        $user->followers()->detach($request->user()->id);

        return back()->with('mensaje', 'Has dejado de seguir a ' . $user->username);
    }
}