@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Iniciar Sesión</h2>

        {{-- Formulario de login --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf {{-- Token de seguridad obligatorio en Laravel --}}

            {{-- Campo Nombre --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full border border-gray-300 rounded px-3 py-2">
                
                {{-- Mostrar error si existe --}}
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo Contraseña --}}
            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Contraseña</label>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Entrar
            </button>
        </form>

        <p class="mt-4 text-center text-sm">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Regístrate</a>
        </p>
    </div>
</div>
@endsection