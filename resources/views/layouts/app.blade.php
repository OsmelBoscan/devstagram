<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')

        <title>FlowStagram - @yield('titulo')</title>
      
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
          
        @livewireStyles
    </head>
    <body class="bg-blue-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex flex-wrap justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-3xl font-black text-gray-800">
                    FlowStagram
                </a>

        
                <!-- Formulario de búsqueda -->
                <form action="{{ route('search') }}" method="GET" class="flex items-center gap-2 mt-4 md:mt-0">
                    <input 
                        type="text" 
                        name="query" 
                        placeholder="Buscar por username..." 
                        class="border rounded-lg p-2 text-sm w-full md:w-64 focus:outline-none focus:ring focus:ring-blue-300"
                    >
                    <button 
                        type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 transition-colors"
                    >
                        Buscar
                    </button>
                </form>

                
        
                <!-- Navegación -->
                @auth
                    <nav class="flex flex-wrap gap-2 items-center mt-4 md:mt-0">
                              <!-- Enlace a notificaciones -->
                      <a href="{{ route('notifications.index') }}" class="relative text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0 1 18 14.158V11a6.002 6.002 0 0 0-4-5.659V4a2 2 0 1 0-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 1 1-6 0m6 0H9" />
                        </svg>
                        <!-- Contador de notificaciones no leídas -->
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full px-2 py-0.5">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                        <a
                            class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"
                            href="{{ route('posts.create') }}"
                        >
                            Crear
                        </a>
        
                        <a class="font-bold text-gray-600 text-sm" 
                            href="{{ route('posts.index', auth()->user()->username) }}"
                        >
                            Hola: 
                            <span class="font-normal"> 
                                {{ auth()->user()->username }}
                            </span>
                        </a>
        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf   
                            <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                                Cerrar Sesión
                            </button>
                        </form>
                    </nav>
                @endauth
        
                @guest
                    <nav class="flex flex-wrap gap-2 items-center mt-4 md:mt-0">
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                    </nav>
                @endguest
            </div>
        </header>
    
        <main class="container mx-auto mt-10 px-4">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>

        <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            FlowStagram - Todos los derechos reservados 
            {{ now()->year }}
        </footer>

        @livewireScripts
    </body>
</html>