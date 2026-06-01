<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class VistaCatalogo extends Model
{
    protected $table = 'vista_catalogo';
    public $timestamps = false;

    protected static function booted(): void
    {
        // Esto se ejecutará AUTOMÁTICAMENTE en cada consulta a la vista
        static::addGlobalScope('idiomaActual', function (Builder $builder) {
            // Filtramos siempre por el idioma que el usuario tenga en la web
            $builder->where('idioma', app()->getLocale());
        });
    }
}
