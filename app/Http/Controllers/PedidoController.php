<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class PedidoController extends Controller
{
    public function index(Request $request) {

        $texto = $request->input('texto');

        // obtener los pedidos filtrados por el texto de busqueda, con la relacion de usuario y detalles
        $query = Pedido::with('user', 'detalles.producto')->orderBy('id', 'desc');

        // PERMISOS
        if (auth()->user()->can('pedido-list')) {
            // puede ver todos los pedidos
        } elseif (auth()->user()->can('pedido-view')) {
            // puede ver solo sus propios pedidos
            $query->where('user_id', auth()->id());
        } else {
            // no tiene permisos para ver pedidos
            abort(403, 'No tienes permisos para ver pedidos');
        }

        // busqueda por nombre de usuario
        if (!empty($texto)) {
            $query->whereHas('user', function($q) use ($texto) {
                $q->where('name', 'like', '%{$texto}%');
            });
        }

        $registros = $query->paginate(10);
        return view('pedido.index', compact('registros', 'texto'));


    }

    public function realizar(Request $request) {

        // Validar que el carrito no esté vacío
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->back()->with('mensaje', 'El carrito está vacío');
        }

        DB::beginTransaction();
        try {
            // 1. Calcular el total del pedido
            $total = 0;
            foreach ($carrito as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }

            // 2. Crear el pedido
            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'estado' => 'pendiente',
            ]);

            // 3. Crear los detalles del pedido
            foreach ($carrito as $productoId => $item) {
                PedidoDetalle::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $productoId,
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                ]);
            }

            // 4. Vaciar el carrito de la sesión
            session()->forget('carrito');
            DB::commit();
            return redirect()->route('carrito.mostrar')->with('mensaje', 'Pedido realizado con éxito');      
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al realizar el pedido');
        }
    }

    public function cambiarEstado(Request $request, $id) {

        $pedido = Pedido::findOrFail($id);

        $estadoNuevo = $request->input('estado');

        // Validar que el estado nuevo sea uno permitido y valido - por defecto tendra 'pendiente'
        $estadosPermitidos = ['enviado', 'anulado', 'cancelado'];

        if (!in_array($estadoNuevo, $estadosPermitidos)) {
            abort(400, 'Estado no válido');
        }

        // Verificar permisos segun el estado del pedido
        // Solo el usuario que tenga e permiso de 'pedido-anulate' puede cambiar el estado a 'enviado' o 'anulado'
        if (in_array($estadoNuevo, ['enviado', 'anulado'])) {
            if (!auth()->user()->can('pedido-anulate')) {
                abort(403, 'No tienes permisos para cambiar el estado del pedido');
            }
        }

        if ($estadoNuevo === 'cancelado') {
            if (!auth()->user()->can('pedido-cancel')) {
                abort(403, 'No tienes permisos para cancelar el pedido');
            }
        }

        // Cambiar el estado del pedido
        $pedido->estado = $estadoNuevo;
        $pedido->save();

        return redirect()->back()->with('mensaje', 'Estado del pedido cambiado a "' . ucfirst($estadoNuevo) . '"');
    }

    

}
