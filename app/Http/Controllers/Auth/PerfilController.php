<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function edit() {

        /** @var \App\Models\User $registro */
        $registro = Auth::user();

        return view('autenticacion.perfil', compact('registro'));
    }

    public function update(UserRequest $request) {

        /** @var \App\Models\User $registro */
        $registro = Auth::user();
        $registro->name = $request->name;
        $registro->email = $request->email;

        if ($request->filled('password')) {
            $registro->password = Hash::make($request->password);
        }

        $registro->save();

        return redirect()->route('perfil.edit')->with('mensaje', 'Perfil atualizado com sucesso!');

    }
}
