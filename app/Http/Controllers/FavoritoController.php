<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function toggle($id){
        $user = Auth::user();
        $user->favoritos()->toggle([$id => ['tiempoCreacion' => now()] ]);

        return back()->with('success', 'Lista de favoritos actualizada.');

    }
}
