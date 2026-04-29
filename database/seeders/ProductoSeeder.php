<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
            DB::table('productos')->insert([
                [
                    'nombre' => 'Bonsái Ficus Retusa',
                    'descripcion' => 'Ideal para principiantes. Muy resistente y perfecto para interiores muy luminosos.',
                    'precio' => 45.50,
                    'stock' => 15,
                    'imagen_url' => 'https://via.placeholder.com/300x300/e0f2f1/004d40?text=Ficus+Retusa',
                    'descuento_id' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nombre' => 'Bonsái Olmo Chino',
                    'descripcion' => 'Bonsái clásico. Gran capacidad de brotación y fácil de modelar. Perfecto para exterior.',
                    'precio' => 55.00,
                    'stock' => 8,
                    'imagen_url' => 'https://via.placeholder.com/300x300/e0f2f1/004d40?text=Olmo+Chino',
                    'descuento_id' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nombre' => 'Bonsái Arce Japonés',
                    'descripcion' => 'Espectacular coloración otoñal en tonos rojos. Requiere protección del sol fuerte en verano.',
                    'precio' => 85.90,
                    'stock' => 5,
                    'imagen_url' => 'https://via.placeholder.com/300x300/e0f2f1/004d40?text=Arce+Japones',
                    'descuento_id' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nombre' => 'Bonsái Pino Negro Japonés',
                    'descripcion' => 'Una joya para expertos. Árbol majestuoso de exterior que requiere técnicas de pinzado avanzadas.',
                    'precio' => 120.00,
                    'stock' => 2,
                    'imagen_url' => 'https://via.placeholder.com/300x300/e0f2f1/004d40?text=Pino+Negro',
                    'descuento_id' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]);
        }
}
