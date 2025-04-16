<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;
use App\Notifications\CommentNotification;

class ComentarioController extends Controller
{
    public function store(Request $request,User $user, Post $post)
    {
        // Validar el comentario
        $request->validate([
            'comentario' => 'required|max:255',
        ]);
    
        // Crear el comentario
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);
        if ($post->user_id !== $request->user()->id) { // Evitar notificar al autor si él mismo comenta
            $post->user->notify(new CommentNotification($post, $request->user()));
        }
    
        return back()->with('mensaje', 'Comentario agregado correctamente');
    }

}