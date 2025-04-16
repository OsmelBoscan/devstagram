@extends('layouts.app')

@section('titulo', 'Notificaciones')

@section('contenido')
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">Notificaciones</h1>

        @if ($notifications->count())
            <ul class="bg-white shadow-md rounded-lg p-5">
                @foreach ($notifications as $notification)
                    <li class="border-b border-gray-200 py-3">
                        <p class="text-gray-700">{{ $notification->data['message'] }}</p>
                        @if (isset($notification->data['post_id']) && isset($notification->data['username']))
                            <a href="{{ route('posts.show', ['user' => $notification->data['username'], 'post' => $notification->data['post_id']]) }}" class="text-blue-500 hover:text-blue-700">
                                Ver publicación
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>

            <form action="{{ route('notifications.markAsRead') }}" method="POST" class="mt-5">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Marcar todas como leídas
                </button>
            </form>
        @else
            <p class="text-gray-500">No tienes notificaciones nuevas.</p>
        @endif
    </div>
@endsection