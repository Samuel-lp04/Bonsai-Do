<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use \App\Models\Direccion;

class CarroController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('catalogo', compact('productos'));
    }

    public function add(Request $request, $id)
    {

        $producto = Producto::findOrFail($id);
        if ($producto->stock <= 0) {
            return back()->with('error', 'Este bonsái está agotado.');
        }
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'imagen_url' => $producto->imagen_url,
                'cantidad' => 1
            ];
        }

        session()->put('carrito', $carrito);
        return back()->with('success', '¡' . $producto->nombre . ' añadido a tu cesta!');
    }

    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        return view('compra/carrito', compact('carrito'));
    }

    public function checkout()
    {
        $direcciones = Direccion::where('user_id', auth()->id())->get();

        $total_del_carro = 0;
        if (session('carrito')) {
            foreach (session('carrito') as $item) {
                $total_del_carro += $item['precio'] * $item['cantidad'];
            }
        }

        return view('compra/checkout', compact('direcciones', 'total_del_carro'));
    }

    public function misPedidos()
    {
        $pedidos = Pedido::where('user_id', auth()->id())->get();

        return view('pedidos/mis-pedidos', compact('pedidos'));
    }

    public function procesarCompra(Request $request)
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('catalogo')->with('error', 'Tu carrito está vacío.');
        }

        $direccion = Direccion::findOrFail($request->input('direccion_id'));

        $direccionString = $direccion->calle . ' ' . $direccion->numero . ', CP: ' . $direccion->codigo_postal . ' ' . $direccion->ciudad;

        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        $pedido = new Pedido();
        $pedido->user_id = auth()->id();
        $pedido->direccion_envio = $direccionString;
        $pedido->total = $total;
        $pedido->estado_pedido = 'En preparación';
        $pedido->fecha_pedido = now();
        $pedido->save();

        session()->forget('carrito');


        return redirect()->route('mis-pedidos')->with('success', '¡Pedido #' . $pedido->id . ' realizado con éxito!');
    }

    public function guardarDireccion(Request $request)
    {
        $direccion = new Direccion();
        $direccion->user_id = auth()->id();
        $direccion->calle = $request->input('calle');
        $direccion->numero = $request->input('numero');
        $direccion->ciudad = $request->input('ciudad');
        $direccion->codigo_postal = $request->input('codigo_postal');
        $direccion->save();

        return back()->with('success', 'Nueva dirección añadida correctamente.');
    }

    public function updateCantidad(Request $request, $id)
    {
        $carrito = session()->get('carrito', []);
        $accion = $request->input('accion');

        if (isset($carrito[$id])) {
            if ($accion == 'sumar') {
                $carrito[$id]['cantidad']++;
            } elseif ($accion == 'restar' && $carrito[$id]['cantidad'] > 1) {
                $carrito[$id]['cantidad']--;
            } elseif ($accion == 'restar' && $carrito[$id]['cantidad'] == 1) {
                unset($carrito[$id]);
            }

            session()->put('carrito', $carrito);
        }

        return back()->with('success', 'Cantidad actualizada');
    }
}
