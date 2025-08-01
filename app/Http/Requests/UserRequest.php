<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        // Obtiene el ID del usuario actual, y si la ruta esta vacia, se usa el ID del usuario autenticado. Tomá el parámetro usuario de la ruta, y si no existe, usá el ID del usuario autenticado."
        $id = $this->route('usuario') ?? Auth::id();  // devolverá el valor de {usuario}, por ejemplo: 5
        // Para ver si se esta editando el perfil del usuario como admin, o si el mismo usuario esta editando su propio perfil.  

        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id), // Verifica que el email sea único, ignorando el usuario actual con su id si se esta editando, para permitir dejar sin modificar el email de un registro existente. ES DECIR, SI NO MODIFICA UN EMAIL, NO LO TOMES COMO UNO QUE NO EXISTE, PORQUE YA EXISTE Y LE PERTENECE A ESTE USUARIO.
            ],
        ];

        if ($method === 'POST') {
            $rules['password'] = 'required|min:8|confirmed'; // Obligatorio al crear un nuevo usuario
        } else if ($method === ['PUT', 'PATCH']) {
            $rules['password'] = 'nullable|min:8|confirmed'; // No obligatario al editar, pero si se proporciona, debe cumplir con las reglas
        }

        return $rules;
        // El unique:users,email,' . $this->route('usuario') hace que la validación ignore el usuario actual al verificar la unicidad del correo electrónico. En otras palabras, si se esta editando un usuario, y no le he cambiado el email, que se permita actualizar el usuario sin cambiar el email.
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico es inválido.',
            'email.unique' => 'El correo electrónico ya está en uso.',

            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.required' => 'La contraseña es obligatoria al crear un nuevo usuario.',
            'password.confirmed' => 'Las contraseñas no coinciden. Por favor, verifique su contraseña.'
        ];
    }
}
