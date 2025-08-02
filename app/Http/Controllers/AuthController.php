<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Se importa la clase Auth para manejar la autenticación

class AuthController extends Controller
{
    // La funcion esperara los datos del formulario de login que vienen en el request
    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // El objeto request contiene varios valores, pero solo necesitamos email y password, creando un array con los datos que se necesitan
        $credenciales = $request->only('email', 'password');

        // Se revisa la tabla user, y se comprueba si el usuario existe y la contraseña es correcta
        if(Auth::attempt($credenciales)) {
            $user = Auth::user(); // Si el registro existe, se crea un user con el usuario autenticado

            // validar que este activo
            if($user->activo) {
                return redirect()->intended(); // Intended redirige al usuario a la ruta que estaba intentando acceder antes de ser redirigido al login
            } else {
                Auth::logout(); // Si el usuario no esta activo, se cierra la sesion
                return back()->with('error', 'Su cuenta esta inactiva. Contacte al administrador.');
            }
        }

        return back()->with('error', 'Credenciales incorrectas.')->withInput();
        // Si no se encuentra el usuario, se redirige al login con un mensaje de error
    }
}
