<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\Models\Pedido;
use \App\Models\Direccion;

class ProfileController extends Controller
{

    public function edit()
    {
        $favoritos = auth()->user()->favoritos;
        $pedidos = auth()->user()->pedidos ?? Pedido::where('user_id', auth()->id())->get();
        $direcciones = auth()->user()->direcciones ?? Direccion::where('user_id', auth()->id())->get();

        return view('profile.edit', compact('favoritos', 'pedidos', 'direcciones'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name' => $request->name,
            'telefono' => $request->telefono,
            'email' => $request->email,
        ]);

        return back()->with('success', '¡Datos actualizados correctamente!');
    }


    public function password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', '¡Contraseña cambiada con éxito!');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Tu cuenta ha sido eliminada. ¡Esperamos verte pronto!');
    }

    public function borrarSeleccionada(Request $request)
    {
        $direccion = Direccion::findOrFail($request->direccion_id);
        $direccion->delete();
        return back();
    }

    public function editarSeleccionada(Request $request)
    {
        $request->validate([
            'direccion_id' => 'required|exists:direcciones,id'
        ]);

        $direccion = Direccion::findOrFail($request->direccion_id);

        return view('profile.editar-direccion', compact('direccion'));
    }

    public function actualizarDireccion(Request $request, $id)
    {
        $direccion = Direccion::findOrFail($id);

        $direccion->update([
            'calle'         => $request->calle,
            'numero'        => $request->numero,
            'ciudad'        => $request->ciudad,
            'codigo_postal' => $request->codigo_postal,
        ]);

        return redirect()->route('profile.edit');
    }
}