<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
        // Almacenar el metodo HTTP utilizado para la solicitud
        $method = $this->method();

        // Obtén el valor del parámetro producto que viene en la ruta, el cual es el ID del producto que se está editando o eliminando.
        $id = $this->route('producto');

        // el unique:productos,codigo,' . $id lo que hace es validar que producto no tenga el mismo codigo que otro producto, pero si es el mismo producto que se esta editando, de ser asi no lo valida.
        $rules = [
            'codigo' => ['required', 'string', 'max:16', 'unique:productos,codigo,' . $id],
            'nombre' => ['required', 'string', 'max:100'],
            'precio' => ['required', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'imagen' => [$method === 'POST' ?  'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];

        return $rules;
    }

    public function messages(): array {

        return [
            'codigo.required' => 'El código del producto es obligatorio.',
            'codigo.unique' => 'El código del producto ya está en uso.',
            'codigo.max' => 'El código del producto no puede exceder los 16 caracteres.',

            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre del producto no puede exceder los 100 caracteres.',

            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser al menos 0.',

            'descripcion.max' => 'La descripción del producto no puede exceder los 1000 caracteres.',

            'imagen.required' => 'La imagen del producto es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo jpg, jpeg o png.',
            'imagen.max' => 'La imagen no puede exceder los 2MB.',
        ];
    }
}
