<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoTraduccion extends Model
{
    protected $table = 'producto_traducciones'; 

    protected $fillable = [
        'producto_id', 
        'idioma', 
        'nombre', 
        'descripcion'
    ];
}
