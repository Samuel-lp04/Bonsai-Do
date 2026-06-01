<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Producto;

class FavoritoController extends Controller
{
    public function toggle($id){
        $user = Auth::user();
        $user->favoritos()->toggle([$id => ['tiempoCreacion' => now()] ]);

        return back()->with('success', __('messages.Success_Fav'));

    }

    public function listar(){
        $productosTop = Producto::withCount('usuariosFavoritos')->orderBy('usuarios_favoritos_count', 'desc')->get();
        return view('admin.favoritos.index', compact('productosTop'));
    }

}
