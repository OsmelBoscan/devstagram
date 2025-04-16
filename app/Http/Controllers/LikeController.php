<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Notifications\LikeNotification;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Crear el like
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        // Enviar notificación al autor del post
        if ($post->user && $post->user_id !== $request->user()->id) { // Evitar notificar al autor si él mismo da like
            $post->user->notify(new LikeNotification($post, $request->user()));
        }

        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        // Eliminar el like
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}