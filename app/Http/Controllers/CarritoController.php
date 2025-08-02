<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {

        // en la vista enviaremos el id del producto y la cantidad
        $producto = Producto::findOrFail($request->id);

        // Verificar si el producto ya está en el carrito
        // cuando se hace ?? se evalua si la variable es null, si no lo es, se toma el valor de la variable, y si esta vacia, se toma el valor de la segunda parte, que en este caso es 1
        $cantidad = $request->cantidad ?? 1;

        // Obtener el carrito de la sesión, inicializandolo como un array vacío si no existe
        $carrito = session()->get('carrito', []);

        // si el producto ya esta en el carrito, se incrementa la cantidad
        if (isset($carrito[$producto->id])) {
            // Si el producto ya está en el carrito, incrementamos la cantidad
            $carrito[$producto->id]['cantidad'] += $cantidad;
        } else {
            // no existe, lo agregamos al carrito
            $carrito[$producto->id] = [
                "nombre" => $producto->nombre,
                "precio" => $producto->precio,
                "imagen" => $producto->imagen,
                "cantidad" => $cantidad,
                "codigo" => $producto->codigo
            ];
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        return redirect()->back()->with('mensaje', 'Producto agregado al carrito exitosamente.');
    }

    public function mostrar()
    {

        $carrito = session('carrito', []);

        return view('web.pedido', compact('carrito'));
    }


    // COMO YA NO PUEDO TRABAJAR CON AGREGAR, YA QUE EL PRODUCTO YA SE AGREGA AL CARRITO, SOLO PUEDO ACTUALIZAR LA CANTIDAD
    public function sumar(Request $request)
    {

        // Obtener el ID del producto desde la solicitud para saber cual producto se va a actualizar
        $productoId = $request->producto_id;

        $carrito = session()->get('carrito', []);

        // Si el producto existe en el carrito, incrementamos su cantidad
        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad'] += 1;
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('mensaje', 'Producto actualizado en el carrito.');
    }

    public function restar(Request $request)
    {

        // Obtener el ID del producto desde la solicitud para saber cual producto se va a actualizar
        $productoId = $request->producto_id;

        $carrito = session()->get('carrito', []);

        // Si el producto existe en el carrito, incrementamos su cantidad
        if (isset($carrito[$productoId])) {

            if ($carrito[$productoId]['cantidad'] > 1) {
                // restamos la cantidad del producto
                $carrito[$productoId]['cantidad'] -= 1;

            } else {
                // si es 1, le quitamos el producto del carrito
                unset($carrito[$productoId]);
            }
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('mensaje', 'Producto actualizado en el carrito.');
    }


    // se usa id y no producto_id viene del formulario, pero aquí el ID se pasa por la URL, no dentro de un formulario. Laravel lo infiere automáticamente desde la ruta.
    public function eliminar($id) {

        // Obtener el carrito de la sesión
        $carrito = session()->get('carrito');

        // Verificar si el producto existe en el carrito
        if (isset($carrito[$id])) {
            unset($carrito[$id]); // Eliminar el producto del carrito
            session()->put('carrito', $carrito); // Actualizar el carrito en la sesión
        }
        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    public function vaciar() {

        // Vaciar el carrito de la sesión
        session()->forget('carrito');
        
        return redirect()->back()->with('success', 'Carrito vaciado exitosamente.');
    }
}
