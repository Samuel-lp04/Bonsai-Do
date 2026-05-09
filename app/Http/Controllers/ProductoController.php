<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductoController extends Controller
{
    
    public function index()
    {
        $productos = Producto::all();
    
        return view('admin.productos.index', compact('productos'));
    }

    
    public function create()
    {
        return view('admin.productos.create');
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric|min:0',
            'categorias' => 'required|array', // Validamos que llegue un array de IDs
            'categorias.*' => 'exists:categorias,id', // Que esos IDs existan realmente
            'stock' => 'required|integer|min:0',
            'imagen_url' => 'required|url',
        ]);

        try {
            // 2. Iniciamos la Transacción: Es un "Todo o Nada"
            DB::transaction(function () use ($request) {
                
                // Creamos el producto. (Asegúrate de que tus campos estén en el $fillable del Modelo)
                $producto = Producto::create($request->except('categorias'));

                // 3. Magia de sync(): Vincula el producto con todas las categorías recibidas
                $producto->categorias()->sync($request->categorias);
                
            });

            // Si llegamos aquí, ambas cosas se guardaron perfectamente (Commit)
            return redirect()->route('admin.productos.index')->with('success', '¡Bonsái creado y categorizado correctamente!');

        } catch (Exception $e) {
            // 4. Manejo de Errores: Si algo falla arriba, se hace un Rollback automático
            // Redirigimos atrás devolviendo lo que el usuario había escrito (withInput)
            return back()->withInput()->with('error', 'Error crítico al guardar: No se ha podido completar la operación. Detalles: ' . $e->getMessage());
        }
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
    
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric|min:0',
            'categorias' => 'required|array',
            'categorias.*' => 'exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'imagen_url' => 'required|url',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                
                // Buscamos el producto
                $producto = Producto::findOrFail($id);
                
                // Actualizamos sus datos básicos
                $producto->update($request->except('categorias'));

                // Actualizamos las categorías.
                // sync() es inteligente: borra las que ya no están marcadas y añade las nuevas.
                $producto->categorias()->sync($request->categorias);
                
            });

            return redirect()->route('admin.productos.index')->with('success', '¡Bonsái actualizado correctamente!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Error crítico al actualizar: Los cambios han sido revertidos por seguridad. Detalles: ' . $e->getMessage());
        }
    }

    
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
    
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Bonsái eliminado correctamente');
    }
}
