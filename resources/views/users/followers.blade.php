@extends('layouts.app')

@section('titulo')
    Seguidores de {{ $user->username }}
@endsection

@section('contenido')
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">Seguidores de {{ $user->username }}</h1>

        @if ($followers->count())
            <ul class="bg-white shadow-md rounded-lg p-5">
                @foreach ($followers as $follower)
                    <li class="flex items-center border-b border-gray-200 py-3">
                        <!-- Imagen del perfil -->
                        <img 
                            src="{{ $follower->imagen ? asset('perfiles/' . $follower->imagen) : asset('img/usuario.svg') }}" 
                            alt="Imagen de {{ $follower->name }}" 
                            class="w-10 h-10 rounded-full mr-3"
                        >
                        <!-- Nombre del usuario -->
                        <a href="{{ route('posts.index', $follower->username) }}" class="text-blue-500 font-bold">
                            {{ $follower->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">Este usuario no tiene seguidores aún.</p>
        @endif
    </div>
@endsection