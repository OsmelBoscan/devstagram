<div class="container mx-auto">
    @if ($posts->count())
        <div class="flex flex-col items-center gap-6">
            @foreach ($posts as $post)
                <div class="w-full md:w-3/4 lg:w-1/2 bg-white p-4 rounded-lg shadow-md">
                    <div class="flex items-center gap-4 mb-4">
                        <!-- Username del autor -->
                        <a href="{{ route('posts.index', $post->user->username) }}" class="text-blue-500 font-bold hover:text-blue-700">
                            {{ $post->user->username }}
                        </a>

                        <!-- Cantidad de likes con ícono de corazón -->
                        <div class="flex items-center gap-1 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5 text-red-500">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span>{{ $post->likes->count() }}</span>
                        </div>
                    </div>

                    <!-- Imagen del post -->
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img 
                            src="{{ asset('uploads') . '/' . $post->imagen }}" 
                            alt="imagen del post {{ $post->titulo }}" 
                            class="w-full h-auto rounded-lg shadow-md mb-4"
                        >
                    </a>

                    <!-- Descripción del post -->
                    <p class="text-gray-700">
                        {{ Str::limit($post->descripcion, 120) }}
                    </p>
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