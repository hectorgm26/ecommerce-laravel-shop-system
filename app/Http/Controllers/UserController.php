<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    use AuthorizesRequests; // Permite verificar los permisos del usuario autenticado

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $this->authorize('user-list'); // Verifica que solo los usuarios con el permiso user-list puedan acceder a esta ruta

        $texto = $request->input('texto');

        $registros = User::with('roles')
            ->where('name', 'LIKE', "%{$texto}%")
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
        $this->authorize('user-create');

        $roles = Role::all();

        return view('usuario.action', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->authorize('user-create');

        $registro = new User();

        $registro->name = $request->input('name');
        $registro->email = $request->input('email');
        $registro->password = Hash::make($request->input('password'));
        $registro->activo= $request->input('activo');
        $registro->save();

        $registro->assignRole($request->input('role')); // Asigna el rol seleccionado en el formulario 

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
        $this->authorize('user-edit');

        $roles = Role::all();

        $registro = User::findOrFail($id);
        // con User $usuario como parametros hubiera sido: 
        // $registro = User::findOrFail($usuario->id);

        return view('usuario.action', compact('registro', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $this->authorize('user-edit');

        $registro = User::findOrFail($id);

        $registro->name = $request->input('name');
        $registro->email = $request->input('email');

        // Si existe contenido en el input de password, se actualiza, sino, se deja el mismo que ya tiene
        if ($request->filled('password')) {
            $registro->password = Hash::make($request->input('password'));
        }

        $registro->activo = $request->input('activo');
        $registro->save();

        $registro->syncRoles($request->input('role')); // Actualiza el rol del usuario en base a lo seleccionado en el formulario, si tenia antes otro rol, lo elimina y asigna el nuevo

        return redirect()->route('usuarios.index')->with('mensaje', 'Registro ' . $registro->name . ' actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('user-delete');

        $registro = User::findOrFail($id);
        $registro->delete();

        return redirect()->route('usuarios.index')->with('mensaje', 'Registro ' . $registro->name . ' eliminado correctamente.');
    }

    // Funcionalidad para hacer un soft delete
    // Se podria igualmente haber trabajado con $id como en los metodos anteriores
    public function toggleStatus(User $usuario) {

        $this->authorize('user-activate');

        $usuario->activo = !$usuario->activo; // Cambia el estado activo del usuario al valor contrario
        $usuario->save();

        return redirect()->route('usuarios.index')->with('mensaje', 'Estado del usuario ' . $usuario->name . ' actualizado correctamente.');
    }
}
