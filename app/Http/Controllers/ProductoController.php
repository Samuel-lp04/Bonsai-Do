<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductoController extends Controller
{
    
    public function index()
    {
        $productos = Producto::with('categorias')->get();
    
        return view('admin.productos.index', compact('productos'));
    }

    
    public function create()
    {
        $categorias = Categoria::all();

        return view('admin.productos.create', compact('categorias'));
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000', 
            'precio' => 'required|numeric|min:0', 
            'stock' => 'required|integer|min:0', 
            'imagen_url' => 'required|string|max:255',
            'descuento_id' => 'nullable|exists:descuentos,id', 
            'categorias' => 'required|array|min:1', 
            'categorias.*' => 'exists:categorias,id',
        ], [
            'precio.min' => 'El precio de un producto no puede ser negativo.',
            'stock.min' => 'El stock mínimo permitido es 0.',
            'categorias.min' => 'Debes asignar al menos una categoría al bonsái.',
            'descuento_id.exists' => 'El descuento seleccionado no es válido en el sistema.'
        ]);

        try {
            DB::transaction(function () use ($request) {
                
                $producto = Producto::create($request->except('categorias'));

                $producto->categorias()->sync($request->categorias);
                
            });

            return redirect()->route('productos.index')->with('success', '¡Bonsái creado y categorizado correctamente!');

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
        $categorias = Categoria::all();
        $categoriasSeleccionadas = $producto->categorias;
        $idCategoriasSeleccionadas = $categoriasSeleccionadas->pluck('id')->toArray();

        return view('admin.productos.edit', compact('producto', 'categorias', 'idCategoriasSeleccionadas'));
    }

    public function update(Request $request, string $id)
    {
    
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000', 
            'precio' => 'required|numeric|min:0', 
            'stock' => 'required|integer|min:0', 
            'imagen_url' => 'required|string|max:255',
            'descuento_id' => 'nullable|exists:descuentos,id', 
            'categorias' => 'required|array|min:1', 
            'categorias.*' => 'exists:categorias,id',
        ], [
            'precio.min' => 'El precio de un producto no puede ser negativo.',
            'stock.min' => 'El stock mínimo permitido es 0.',
            'categorias.min' => 'Debes asignar al menos una categoría al bonsái.',
            'descuento_id.exists' => 'El descuento seleccionado no es válido en el sistema.'
        ]);
        
        try {
            DB::transaction(function () use ($request, $id) {
                
                $producto = Producto::findOrFail($id);
                
                $producto->update($request->except('categorias'));

                $producto->categorias()->sync($request->categorias);
                
            });

            return redirect()->route('productos.index')->with('success', '¡Bonsái actualizado correctamente!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Error crítico al actualizar: Los cambios han sido revertidos por seguridad. Detalles: ' . $e->getMessage());
        }
    }

    
    public function destroy(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $producto = Producto::findOrFail($id);
                $producto->categorias()->detach();
                $producto->delete();
            });

            return redirect()->route('productos.index')->with('success', 'Bonsái eliminado correctamente.');

        } catch (Exception $e) {
            return redirect()->route('productos.index')->with('error', 'No se puede eliminar el producto porque está siendo utilizado en pedidos o favoritos.');
        }
    }
}