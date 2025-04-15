@extends('layouts.app')

@section('titulo')
    Siguiendo de {{ $user->username }}
@endsection

@section('contenido')
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">Usuarios que {{ $user->username }} está siguiendo</h1>

        @if ($followings->count())
            <ul class="bg-white shadow-md rounded-lg p-5">
                @foreach ($followings as $following)
                    <li class="flex items-center border-b border-gray-200 py-3">
                        <!-- Imagen del perfil -->
                        <img 
                            src="{{ $following->imagen ? asset('perfiles/' . $following->imagen) : asset('img/usuario.svg') }}" 
                            alt="Imagen de {{ $following->name }}" 
                            class="w-10 h-10 rounded-full mr-3"
                        >
                        <!-- Nombre del usuario -->
                        <a href="{{ route('posts.index', $following->username) }}" class="text-blue-500 font-bold">
                            {{ $following->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">Este usuario no está siguiendo a nadie aún.</p>
        @endif
    </div>
@endsection