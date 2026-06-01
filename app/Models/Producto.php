<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'productos';

    protected $fillable = [
        'precio',
        'stock',
        'imagen_url',
        'descuento_id'
    ];

    public function traducciones()
    {
        return $this->hasMany(ProductoTraduccion::class, 'producto_id');
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

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_producto')->withTimestamps();
    }

    public function descuento()
    {
        return $this->belongsTo(Descuento::class, 'descuento_id');
    }

    public function usuariosFavoritos(){
        return $this->belongsToMany(User::class, 'favoritos', 'producto_id', 'user_id')->withPivot('tiempoCreacion')->withTimestamps();
    }
}
