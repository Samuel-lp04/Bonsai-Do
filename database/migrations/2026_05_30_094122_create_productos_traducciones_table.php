<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos_traducciones', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('producto_id')
                  ->constrained('productos')
                  ->onDelete('cascade');
            
            $table->string('idioma', 5);

            $table->string('nombre');
            $table->text('descripcion')->nullable();
            
            $table->timestamps();

            $table->unique(['producto_id', 'idioma']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_traducciones');
    }
};
