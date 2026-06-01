<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaTraduccion extends Model
{
    protected $table = 'categorias_traducciones'; 

    protected $fillable = [
        'categoria_id', 
        'idioma', 
        'nombre', 
        'descripcion'
    ];
}
