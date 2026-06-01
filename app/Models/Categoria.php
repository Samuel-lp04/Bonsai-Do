<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function traducciones()
    {
        return $this->hasMany(CategoriaTraduccion::class, 'categoria_id');
    }

    public function getNombreAttribute()
    {
        $idiomaActual = app()->getLocale();
        $traduccion = $this->traducciones->where('idioma', $idiomaActual)->first();

        if (!$traduccion || empty($traduccion->nombre)) {
            $traduccion = $this->traducciones->where('idioma', 'es')->first();
        }

        return $traduccion ? $traduccion->nombre : 'Sin título';
    }

    public function getDescripcionAttribute()
    {
        $idiomaActual = app()->getLocale();
        $traduccion = $this->traducciones->where('idioma', $idiomaActual)->first();

        if (!$traduccion || empty($traduccion->descripcion)) {
            $traduccion = $this->traducciones->where('idioma', 'es')->first();
        }

        return $traduccion ? $traduccion->descripcion : '';
    }
}


