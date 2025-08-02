<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class WebController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();

        // busqueda por nombre
        if ($request->has('search') && $request->search) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }

        // filtro por orden (orden de precio)
        if ($request->has('sort') && $request->sort) {
            switch ($request->sort) {
                case 'priceAsc':
                    $query->orderBy('precio', 'asc');
                    break;
                case 'priceDesc':
                    $query->orderBy('precio', 'desc');
                    break;
                default:
                    $query->orderBy('nombre', 'desc');
                    break;
            }
        }

        // obtener los productos filtrados
        $productos = $query->paginate(10);

        return view('web.index', compact('productos'));
    }

    public function show($id) {

        // obtener el producto por id
        $producto = Producto::findOrFail($id);

        // pasar el producto a la vista
        return view('web.item', compact('producto'));
    }
}
