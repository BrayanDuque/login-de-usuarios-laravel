<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema')</title>
    <!-- Usamos TailwindCSS desde CDN para que se vea bonito sin instalar nada -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    {{-- Solo mostramos el menú si el usuario está logueado --}}
    @auth
    <nav class="bg-white shadow mb-6">
        <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex space-x-4">
                <a href="{{ route('dashboard') }}" class="font-bold text-gray-800">Dashboard</a>
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-900">Usuarios</a>
            </div>

            <div class="flex items-center space-x-4">
                {{-- Mostramos el nombre del usuario logueado --}}
                <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>

                {{-- Formulario para cerrar sesión --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <div class="max-w-5xl mx-auto px-4">

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensaje de error --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Aquí se inserta el contenido de cada página --}}
        @yield('content')
    </div>

</body>
</html>