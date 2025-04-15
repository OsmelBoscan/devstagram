@extends('layouts.app')

@section('titulo')
    Resultados de búsqueda: "{{ $query }}"
@endsection

@section('contenido')
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">Resultados de búsqueda para: "{{ $query }}"</h1>

        @if ($users->count())
            <ul class="bg-white shadow-md rounded-lg p-5">
                @foreach ($users as $user)
                    <li class="flex items-center border-b border-gray-200 py-3">
                        <!-- Imagen del perfil -->
                        <img 
                            src="{{ $user->imagen ? asset('perfiles/' . $user->imagen) : asset('img/usuario.svg') }}" 
                            alt="Imagen de {{ $user->username }}" 
                            class="w-10 h-10 rounded-full mr-3"
                        >
                        <!-- Username del usuario -->
                        <a href="{{ route('posts.index', $user->username) }}" class="text-blue-500 font-bold">
                            {{ $user->username }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">No se encontraron resultados para "{{ $query }}".</p>
        @endif
    </div>
@endsection