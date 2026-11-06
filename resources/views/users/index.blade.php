@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Usuarios Registrados</h1>

    {{-- Botón para ir a crear un nuevo usuario --}}
    <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Registrar Usuario
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Correo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

            {{-- 
                Aquí usamos @foreach para recorrer todos los usuarios 
                que vienen desde el controlador ($users)
            --}}
            @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4">{{ $user->id }}</td>
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4 space-x-2">

                        {{-- Botón Editar --}}
                        <a href="{{ route('users.edit', $user) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                            Editar
                        </a>

                        {{-- Botón Eliminar --}}
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                            @csrf
                            @method('DELETE') {{-- Laravel necesita este método especial para DELETE --}}
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

            {{-- Si no hay usuarios, mostramos un mensaje --}}
            @if($users->isEmpty())
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        No hay usuarios registrados todavía.
                    </td>
                </tr>
            @endif

        </tbody>
    </table>
</div>
@endsection