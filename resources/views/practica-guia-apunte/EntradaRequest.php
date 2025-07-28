<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradaRequest extends FormRequest
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
        // Se definen las reglas de validación para los campos del formulario de entrada
        return [
            'titulo' => 'required|string|min:5|max:50',
            'tag' => 'required|string|min:3|max:20',
            'contenido' => 'required|string|min:5|max:255',
        ];
    }

    // Personalizar los mensajes de error
    public function messages() {
        return [
            'titulo.required' => 'El campo título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.min' => 'El título debe tener al menos :min caracteres.',
            'titulo.max' => 'El título no puede exceder los :max caracteres.',
            
            'tag.required' => 'El campo etiqueta es obligatorio.',
            'tag.string' => 'La etiqueta debe ser una cadena de texto.',
            'tag.min' => 'La etiqueta debe tener al menos :min caracteres.',
            'tag.max' => 'La etiqueta no puede exceder los :max caracteres.',

            'contenido.required' => 'El campo contenido es obligatorio.',
            'contenido.string' => 'El contenido debe ser una cadena de texto.',
            'contenido.min' => 'El contenido debe tener al menos :min caracteres.',
            'contenido.max' => 'El contenido no puede exceder los :max caracteres.',
        ];
    }
}
