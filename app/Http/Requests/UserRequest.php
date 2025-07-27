<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->route('usuario'),
            'password' => 'required|string|min:8'
        ];
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
            'password.required' => 'La contraseña es obligatoria al crear un nuevo usuario.'
        ];
    }
}
