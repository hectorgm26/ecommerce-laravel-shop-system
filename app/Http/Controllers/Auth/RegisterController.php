<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function showRegistroForm() {
        return view('autenticacion.registro');
    }

    public function registrar(UserRequest $request) {
        $usuario = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'activo' => 1 // activado por defecto
        ]);

        // Se busca en la base de datos el rol 'cliente' y se asigna al usuario
        $clienteRol = Role::where('name', 'cliente')->first();

        if ($clienteRol) {
            $usuario->assignRole($clienteRol);
        }

        // Loguearse con el usuario recién creado
        Auth::login($usuario);

        return redirect()->route('dashboard')->with('mensaje', 'Registro exitoso. Bienvenido, ' . $usuario->name . '!');

    }
}
