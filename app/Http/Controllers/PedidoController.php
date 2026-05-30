<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
        {
            $pedidos = Pedido::with('user')->orderBy('created_at', 'desc')->get();
            
            return view('admin.pedidos.index', compact('pedidos'));
        }
    


    public function show($id)
    {
        $pedido = Pedido::with('detalles.producto')->findOrFail($id);

        return view('pedidos.show', compact('pedido'));
    }
}
