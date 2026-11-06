<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // MOSTRAR FORMULARIO DE LOGIN
    
    public function showLogin()
    {
        // Solo devolvemos la vista del login
        return view('auth.login');
    }

    // PROCESAR LOGIN (nombre + contraseña)
        public function login(Request $request)
    {
        // Validamos que se envíen los campos obligatorios
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validated)) {
            // Si las credenciales son correctas, regeneramos la sesión por seguridad
            $request->session()->regenerate();

            // Redirigimos al dashboard
            return redirect()->intended('/dashboard');
        }

        // Si las credenciales están mal, volvemos al formulario con un error
        return back()->withErrors([
            'name' => 'El nombre o la contraseña son incorrectos.',
        ])->onlyInput('name');
    }

    // MOSTRAR FORMULARIO DE REGISTRO
 
    public function showRegister()
    {
        return view('auth.register');
    }

    // PROCESAR REGISTRO (nombre + correo + contraseña)
   
    public function register(Request $request)
    {
        // Validamos los datos que vienen del formulario
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'], // confirmed = debe coincidir con password_confirmation
        ]);

        // Creamos el usuario en la base de datos
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Iniciamos sesión automáticamente después de registrarse
        Auth::login($user);
        $request->session()->regenerate();

        // Redirigimos al dashboard
        return redirect('/dashboard');
    }

    
    // CERRAR SESIÓN
    
    public function logout(Request $request)
    {
        // Cerramos la sesión del usuario
        Auth::logout();

        // Invalidamos la sesión actual
        $request->session()->invalidate();

        // Regeneramos el token CSRF por seguridad
        $request->session()->regenerateToken();

        // Redirigimos al login
        return redirect('/login');
    }
}