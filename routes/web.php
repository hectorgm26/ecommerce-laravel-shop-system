<?php

use App\Http\Controllers\Auth\PerfilController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Solo los usuarios autenticados pueden acceder a estas rutas
Route::middleware(['auth'])->group(function() {

    Route::resource('/usuarios', UserController::class);

    // Ruta para el soft delete
    Route::patch('/usuarios/{usuario}/toggle', [UserController::class, 'toggleStatus'])->name('usuarios.toggle');

    Route::resource('/roles', RoleController::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', function() {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
});

// Agrupacion para evitar que una vez autenticado, el usuario pueda acceder a la pagina de login (por ya estar logueado)
Route::middleware(['guest'])->group(function() {

    Route::get('/login', function () {
        return view('autenticacion.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/registro', [RegisterController::class, 'showRegistroForm'])->name('registro');
    Route::post('/registro', [RegisterController::class, 'registrar'])->name('registro.store');

    // Rutas para el restablecimiento de contraseña
    Route::get('/password/reset', [ResetPasswordController::class, 'showRequestForm'])->name('password.request');
    Route::post('/password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.send-link');

    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});
