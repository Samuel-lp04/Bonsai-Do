<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW vista_catalogo AS SELECT p.id AS producto_id, pt.nombre AS producto_nombre, pt.descripcion, pt.idioma ,p.precio, p.imagen_url, c.id AS categoria_id, ct.nombre AS categoria_nombre FROM productos p LEFT JOIN productos_traducciones pt ON p.id = pt.producto_id LEFT JOIN categoria_producto cp ON p.id = cp.producto_id LEFT JOIN categorias c ON cp.categoria_id = c.id LEFT JOIN categorias_traducciones ct ON c.id = ct.categoria_id");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS vista_catalogo");
    }
};
