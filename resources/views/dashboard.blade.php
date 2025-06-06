@extends('layouts.app')

@section('titulo')
   Perfil: {{$user->username}}
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->imagen ? 
                asset('perfiles') . '/' . $user->imagen : 
                asset('img/usuario.svg') }}" 
                alt="imagen usuario" 
                class="w-full h-64 object-cover rounded-lg shadow-md"
                />
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 md:flex md:flex-col items-center md:items-start md:justify-center py-10 md:py-10">
              
                <div class="flex items-center gap-2">
                <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                @auth
                    @if($user->id === auth()->user()->id)
                        <a 
                        href="{{ route('perfil.index') }}"
                        class="text-gray-500 hover:text-gray-600 cursor-pointer"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                              </svg>
                              
                        </a>
                    @endif
                @endauth
                </div>
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    <a href="{{ route('users.followers', $user->username) }}" class="text-black-500 hover:text-blue-700">
                        {{ $user->followers->count() }}
                        <span class="font-normal"> @choice('Seguidor|Seguidores', $user->followers->count())</span>
                    </a>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    <a href="{{ route('users.followings', $user->username) }}" class="text-black-500 hover:text-blue-700">
                        {{ $user->followings->count() }}
                        <span class="font-normal"> Siguiendo </span>
                    </a>
                </p>
                <p class="text-black-500 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal"> Post</span>
                </p>

                @auth
                    @if ($user->id !== auth()->user()->id)
                         @if (!$user->siguiendo(auth()->user()))
                             
                    <form
                        action="{{ route('users.follow', $user) }}" 
                        method="POST"
                    >
                    @csrf
                        <input
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 transition-colors cursor-pointer rounded-lg px-3 py-1 text-white font-bold uppercase text-xs"
                            value="Seguir"
                        />
                    </form> 

                    @else

                    <form
                    action="{{ route('users.unfollow', $user) }}"
                    method="POST"
                >
                @method('DELETE')
                @csrf
                    <input
                        type="submit"
                        class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer rounded-lg px-3 py-1 text-white font-bold uppercase text-xs"
                        value="Dejar de seguir"
                    />
                </form> 
                        @endif   
                    @endif
                @endauth
            </div>
        </div>
    </div>
    
    <section class="container mx-auto mt-10">
        <div>
            @if ($posts->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($posts as $post)
                        <div class="break-inside-avoid">
                            <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                                <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="imagen del post {{ $post->titulo }}" class="w-full h-64 object-cover rounded-lg shadow-md">
                            </a>
                        </div>
                    @endforeach
                </div>
        
                <div class="my-10">
                    {{ $posts->links() }}
                </div>
            @else
                <p class="text-center">No hay Posts, sigue a alguien para mostrar sus posts</p>
            @endif
        </div>
    </section>

@endsection