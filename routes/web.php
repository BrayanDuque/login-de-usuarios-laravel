<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// ======================
// RUTAS PÚBLICAS (sin login)
// ======================

// Cuando alguien entre a la raíz, lo mandamos al login
Route::get('/', function () {
    return redirect('/login');
});

// Mostrar el formulario de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Procesar el formulario de login (cuando se envía)
Route::post('/login', [AuthController::class, 'login']);

// Mostrar el formulario de registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Procesar el formulario de registro
Route::post('/register', [AuthController::class, 'register']);



Route::middleware('auth')->group(function () {

    // Página principal después de iniciar sesión
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // CRUD de usuarios (index, create, store, edit, update, destroy)
    Route::resource('users', UserController::class);
});