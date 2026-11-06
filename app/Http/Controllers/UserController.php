<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    // LISTAR TODOS LOS USUARIOS (con foreach)
    public function index()
    {
        // Traemos todos los usuarios ordenados del más reciente al más antiguo
        $users = User::latest()->get();

        // Enviamos la variable $users a la vista
        return view('users.index', compact('users'));
    }


    // MOSTRAR FORMULARIO PARA CREAR USUARIO
   
    public function create()
    {
        return view('users.create');
    }

    
    // GUARDAR NUEVO USUARIO (botón Guardar / Registrar)
    
    public function store(Request $request)
    {
        // Validamos los datos
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // Creamos el usuario
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Redirigimos a la lista con un mensaje de éxito
        return redirect()->route('users.index')
            ->with('success', 'Usuario registrado correctamente');
    }

  
    // MOSTRAR FORMULARIO PARA EDITAR
    
    public function edit(User $user)
    {
        // Laravel automáticamente busca el usuario por el id de la URL
        return view('users.edit', compact('user'));
    }


    // ACTUALIZAR USUARIO (botón Guardar)
    
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:191', 'unique:users,email,' . $user->getKey()],
            'password' => ['nullable', 'confirmed', 'min:6'], // opcional
        ]);

        // Datos que siempre se actualizan
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        // Solo actualizamos la contraseña si el usuario escribió una nueva
        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        // Actualizamos el usuario
        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

 
    // ELIMINAR USUARIO (botón Eliminar)
   
    public function destroy(User $user)
    {
        // Evitamos que el usuario se elimine a sí mismo
        if ($user->is(auth()->user())) {
            return redirect()->route('users.index')
                ->with('error', 'No puedes eliminarte a ti mismo');
        }

        // Eliminamos el usuario
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}