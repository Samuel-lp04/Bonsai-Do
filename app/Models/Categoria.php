<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categorias";
    protected $guarded = [];

    public function productos(){
        return $this->belongsToMany(Producto::class, 'categoria_producto');
    }
}


