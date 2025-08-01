<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{

    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('rol-list'); // Verifica que solo los usuarios con el permiso role-list puedan acceder a esta ruta

        $texto = $request->input('texto');

        // trae cada rol con sus permisos
        $registros = Role::with('permissions')->where('name', 'LIKE', "%{$texto}%")
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('role.index', compact('registros', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('rol-create');

        $permissions = Permission::all(); // se agregan todos los permisos disponibles
        return view('role.action', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('rol-create');

        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        // Se crea el rol, tomando el nombre del request del formulario
        $registro = Role::create(['name' => $request->name]);

        // Se asignan los permisos a ese rol. El $request contiene los permisos seleccionados del formulario
        $registro->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('mensaje', 'Rol ' . $registro->name . ' creado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('rol-delete');

        $registro = Role::findOrFail($id);
        $registro->delete();

        return redirect()->route('roles.index')->with('mensaje', 'Rol ' . $registro->name . ' eliminado correctamente.');
    }

    public function edit(string $id) {

        $this->authorize('rol-edit');

        $registro = Role::findOrFail($id);
        $permissions = Permission::all(); // se agregan todos los permisos disponibles

        return view('role.action', compact('registro', 'permissions'));
    }

    public function update(Request $request, string $id) {

        $this->authorize('rol-edit');

        $registro = Role::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:roles,name,' . $registro->id,
            'permissions' => 'required|array',
        ]);
        
        // Se actualiza el nombre del rol
        $registro->name = $request->name;
        $registro->save();

        // Se actualizan los permisos del rol
        $registro->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('mensaje', 'Rol ' . $registro->name . ' actualizado correctamente.');
    }

}
