<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    protected $table = 'descuentos';
    protected $fillable = [
        'nombre',
        'porcentaje',
        'fecha_inicio',
        'fecha_fin'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin'    => 'date',
    ];

    public function productos(){
        return $this->hasMany(Producto::class, 'descuento_id');
    }

    public function esValido(){
        return now()->between($this->fecha_inicio, $this->fecha_fin);
    }
}