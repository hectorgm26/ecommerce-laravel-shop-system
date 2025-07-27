<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = $request->input('texto');

        $registros = User::where('name', 'LIKE', "%{$texto}%")
            ->orWhere('email', 'LIKE', "%{$texto}%")
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('usuario.index', compact('registros', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.action');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $registro = new User();
        $registro->name = $request->input('name');
        $registro->email = $request->input('email');
        $registro->password = bcrypt($request->input('password'));
        $registro->activo= $request->input('activo');
        $registro->save();

        return redirect()->route('usuarios.index')->with('mensaje', 'Registro ' . $registro->name . ' creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $registro = User::findOrFail($id);
        // con User $usuario como parametros hubiera sido: 
        // $registro = User::findOrFail($usuario->id);

        return view('usuario.action', compact('registro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $registro = User::findOrFail($id);

        $registro->name = $request->input('name');
        $registro->email = $request->input('email');
        $registro->password = bcrypt($request->input('password'));
        $registro->activo = $request->input('activo');
        $registro->save();

        return redirect()->route('usuarios.index')->with('mensaje', 'Registro ' . $registro->name . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registro = User::findOrFail($id);
        $registro->delete();

        return redirect()->route('usuarios.index')->with('mensaje', 'Registro ' . $registro->name . ' eliminado correctamente.');
    }

    // Funcionalidad para hacer un soft delete
    // Se podria igualmente haber trabajado con $id como en los metodos anteriores
    public function toggleStatus(User $usuario) {
        $usuario->activo = !$usuario->activo; // Cambia el estado activo del usuario al valor contrario
        $usuario->save();

        return redirect()->route('usuarios.index')->with('mensaje', 'Estado del usuario ' . $usuario->name . ' actualizado correctamente.');
    }
}
