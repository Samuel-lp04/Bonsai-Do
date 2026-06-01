<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Exception;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'traducciones.es.nombre' => 'required|string|unique:categorias_traducciones,nombre|max:100',
            'traducciones.es.descripcion' => 'required|string|max:1000', 
            'traducciones.en.nombre' => 'nullable|string|unique:categorias_traducciones,nombre|max:100',
            'traducciones.en.descripcion' => 'nullable|string|max:1000',
        ]);

        try {
            DB::transaction(function () use ($request) {
                
                $categoria = Categoria::create([]);

                $categoria->traducciones()->create([
                    'idioma'      => 'es',
                    'nombre'      => $request->traducciones['es']['nombre'],
                    'descripcion' => $request->traducciones['es']['descripcion'],
                ]);
                if (!empty($request->traducciones['en']['nombre'])) {
                    $categoria->traducciones()->create([
                        'idioma'      => 'en',
                        'nombre'      => $request->traducciones['en']['nombre'],
                        'descripcion' => $request->traducciones['en']['descripcion'] ?? '',
                    ]);
                }
                
            });

            return redirect()->route('categorias.index')->with('success', 'Categoría creada.');

        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Error crítico al guardar: No se ha podido completar la operación. Detalles: ' . $e->getMessage());
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'traducciones.es.nombre' => [
                'required',
                'string',
                'max:100',
                
                Rule::unique('categorias_traducciones', 'nombre')->ignore($id, 'categoria_id')
            ],
            'traducciones.es.descripcion' => 'required|string', 
            
            'traducciones.en.nombre' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('categorias_traducciones', 'nombre')->ignore($id, 'categoria_id')
            ],
            'traducciones.en.descripcion' => 'nullable|string',
        
        ]);
        try {
            DB::transaction(function () use ($request, $id) {
                
                $categoria = Categoria::findOrFail($id);

                $categoria->traducciones()->updateOrCreate(
                    ['idioma' => 'es'],
                        [
                            'nombre'      => $request->traducciones['es']['nombre'],
                            'descripcion' => $request->traducciones['es']['descripcion'],
                        ]
                );
                if (!empty($request->traducciones['en']['nombre'])) {
                    $categoria->traducciones()->updateOrCreate(
                        ['idioma' => 'en'],
                        [
                            'nombre'      => $request->traducciones['en']['nombre'],
                            'descripcion' => $request->traducciones['en']['descripcion'] ?? '',
                        ]
                    );
                }
                
            });

            return redirect()->route('categorias.index')->with('success', 'Categoría actualizada.');

        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Error crítico al actualizar: Los cambios han sido revertidos por seguridad. Detalles: ' . $e->getMessage());
        }
        

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->productos()->detach();
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
