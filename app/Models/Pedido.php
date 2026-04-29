<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'user_id', 
        'estado_pedido', 
        'total', 
        'direccion_envio', 
        'fecha_pedido'
    ];

    protected $casts = [
        'fecha_pedido' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}
