<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;

use App\Http\Requests\EntradaRequest;

class EntradaController extends Controller
{
    // Index para mostrar una lista de entradas
    public function index(Request $request)
    {
        // return $request->query();
        // return $request->path();
        // return $request->url();
        return $request->input('titulo', 'No hay titulo');
    }

    // Create para mostrar un formulario de creación de una nueva entrada
    public function create()
    {
        return view('entrada.create');
    }

    // Store para guardar una nueva entrada en la base de datos
    // Para crear un validador se usa php artisan make:request EntradaRequest, y dentro de definimos las reglas de validación
    // Se cambia el Request por el EntradaRequest creado, para aplicar las reglas de validación definidas
    public function store(EntradaRequest $request)
    {
        $entrada = new Entrada();

        $entrada->titulo = $request->input('titulo');
        $entrada->tag = $request->input('tag');
        $entrada->contenido = $request->input('contenido');
        $entrada->imagen = "";
        $entrada->user_id = 1;

        $entrada->save();

        return redirect()->route('entrada.create')->with('succes', 'Entrada creada correctamente');
    }

    // Show para mostrar una entrada específica
    public function show(string $id)
    {
        return "show";
    }

    // Edit para mostrar un formulario de edición de una entrada específica
    public function edit(string $id)
    {
        return "Edit";
    }

    // Update para actualizar una entrada específica en la base de datos
    public function update(Request $request, string $id)
    {
        return "Update";
    }

    // Destroy para eliminar una entrada específica de la base de datos
    public function destroy(string $id)
    {
        return "Destroy";
    }
}
