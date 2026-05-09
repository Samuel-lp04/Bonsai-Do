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
        DB::statement("CREATE OR REPLACE VIEW vista_catalogo AS SELECT p.id AS producto_id, p.nombre AS producto_nombre, p.precio, p.imagen_url, c.id AS categoria_id, c.nombre AS categoria_nombre FROM productos p LEFT JOIN categoria_producto cp ON p.id = cp.producto_id LEFT JOIN categorias c ON cp.categoria_id = c.id");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS vista_catalogo");
    }
};
