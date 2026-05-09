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
            'categorias' => 'required|array',
            'categorias.*' => 'exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'imagen_url' => 'required|url',
        ]);

        try {
            DB::transaction(function () use ($request) {
                
                $producto = Producto::create($request->except('categorias'));

                $producto->categorias()->sync($request->categorias);
                
            });

            return redirect()->route('admin.productos.index')->with('success', '¡Bonsái creado y categorizado correctamente!');

        } catch (Exception $e) {
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
                
                $producto = Producto::findOrFail($id);
                
                $producto->update($request->except('categorias'));

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