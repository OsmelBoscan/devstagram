<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function followers(User $user)
{
    $followers = $user->followers; // Obtiene los seguidores del usuario

    return view('users.followers', [
        'user' => $user,
        'followers' => $followers
    ]);
}
public function followings(User $user)
{
    $followings = $user->followings; // Obtiene los usuarios que el usuario está siguiendo

    return view('users.followings', [
        'user' => $user,
        'followings' => $followings
    ]);
}
}
