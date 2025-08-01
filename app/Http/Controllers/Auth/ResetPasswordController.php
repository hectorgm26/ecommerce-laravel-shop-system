<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{

    public function showRequestForm() {

        return view('autenticacion.email');
    }

    public function sendResetLinkEmail(Request $request) {
        // Validar el email ingresado. El exists asegura que el email exista en la tabla de usuarios.
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(60); // Generar un token aleatorio de 60 caracteres

        // Guardar el token en la tabla password_resets por medio de actualización o inserción
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Enviar el email con el enlace de recuperación
        Mail::send('emails.reset-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email)->subject('Recuperación de contraseña - Hector el Father');
        });

        // Retorna a la vista anterior con un mensaje de éxito
        return back()->with('mensaje', 'Hemos enviado un enlace de recuperación a su correo electrónico.');
    }

    public function showResetForm($token) {
        return view('autenticacion.reset', compact('token'));
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        // Verificar si el token es válido y no ha expirado. El token se recibe de un input oculto en el formulario de reset.
        $reset = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        // Si no se encuentra un registro coincidente, o que el email no coincida, retornar un error
        if (!$reset || $reset->email !== $request->email) {
            return back()->withErrors(['email' => 'Token invalido o expirado.']);
        }

        // Obtener el nombre de usuario y actualizar su contraseña
        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        // Eliminar la fila del token de la tabla password_resets para evitar que se use nuevamente
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Redirigir al usuario a la página de login con un mensaje de éxito
        return redirect()->route('login')->with('mensaje', 'Contraseña actualizada exitosamente. Ahora puede iniciar sesión.');
    }
}
