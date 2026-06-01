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
        Schema::create('categorias_traducciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->onDelete('cascade');

            $table->string('idioma', 5);

            $table->string('nombre');
            $table->string('descripcion')->nullable();

            $table->timestamps();

            $table->unique(['categoria_id','idioma']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias_traducciones');
    }
};
