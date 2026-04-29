<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // 1. Mostrar la vista del perfil (Read)
    public function edit()
    {
        return view('profile.edit'); 
    }

    // 2. Actualizar datos básicos (Update)
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:20'],
            // La siguiente línea comprueba que el email no lo use OTRA persona
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name' => $request->name,
            'telefono' => $request->telefono,
            'email' => $request->email,
        ]);

        return back()->with('success', '¡Datos actualizados correctamente!');
    }

    // 3. Cambiar la contraseña (Update)
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

    // 4. Borrar cuenta (Delete)
    public function destroy(Request $request)
    {
        $user = Auth::user();
        
        // Cerramos la sesión por seguridad antes de borrar
        Auth::logout();
        
        $user->delete();

        // Invalidamos la sesión antigua y mandamos a la pantalla de inicio
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Tu cuenta ha sido eliminada. ¡Esperamos verte pronto!');
    }
}