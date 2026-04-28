<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarroController extends Controller
{
    public function index(){
        $productos = Producto::all();
        return view('catalogo', compact('productos'));
    }

    public function add(Request $request, $id){

        $producto = Producto::findOrFail($id); 
        if($producto->stock <= 0) {
            return back()->with('error', 'Este bonsái está agotado.');
        }
        $carrito = session()->get('carrito', []);

        if(isset($carrito[$id])) {
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

    public function verCarrito(){
        $carrito = session()->get('carrito', []);
        return view('carrito', compact('carrito'));
    }

    public function checkout(){
        return view('checkout');
    }
}
