<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

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
            'stock' => 'required|integer|min:0',
            'imagen_url' => 'required|url',
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->imagen_url = $request->imagen_url;
        
        $producto->save();

        return redirect()->route('productos.index')->with('success', '¡Bonsái creado con éxito!');
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
            'stock' => 'required|integer|min:0',
            'imagen_url' => 'required|url',
        ]);

        $producto = Producto::findOrFail($id);
    
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->imagen_url = $request->imagen_url;
        
        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Bonsái actualizado correctamente');
    }

    
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
    
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Bonsái eliminado correctamente');
    }
}
