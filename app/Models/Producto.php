<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen_url',
        'descuento_id'
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_producto')->withTimestamps();
    }

    public function descuento()
    {
        return $this->belongsTo(Descuento::class, 'descuento_id');
    }
}
