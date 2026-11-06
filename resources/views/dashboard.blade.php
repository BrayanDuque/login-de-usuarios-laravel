@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-2">Bienvenido, {{ auth()->user()->name }}</h1>
    <p class="text-gray-600 mb-6">Has iniciado sesión correctamente.</p>

    <a href="{{ route('users.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Ver todos los usuarios
    </a>
</div>
@endsection