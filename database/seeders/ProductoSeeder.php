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
        $productos = [
            [
                'datos_base' => [
                    'precio' => 45.50,
                    'stock' => 15,
                    'imagen_url' => 'images/FicusRetusa.jpg',
                    'descuento_id' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                'traducciones' => [
                    [
                        'idioma' => 'es',
                        'nombre' => 'Bonsái Ficus Retusa',
                        'descripcion' => 'Ideal para principiantes. Muy resistente y perfecto para interiores muy luminosos.',
                    ],
                    [
                        'idioma' => 'en',
                        'nombre' => 'Ficus Retusa Bonsai',
                        'descripcion' => 'Ideal for beginners. Very resistant and perfect for very bright interiors.',
                    ]
                ]
            ],
            [
                'datos_base' => [
                    'precio' => 55.00,
                    'stock' => 8,
                    'imagen_url' => 'images/OlmoChino.jpg',
                    'descuento_id' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                'traducciones' => [
                    [
                        'idioma' => 'es',
                        'nombre' => 'Bonsái Olmo Chino',
                        'descripcion' => 'Bonsái clásico. Gran capacidad de brotación y fácil de modelar. Perfecto para exterior.',
                    ],
                    [
                        'idioma' => 'en',
                        'nombre' => 'Chinese Elm Bonsai',
                        'descripcion' => 'Classic bonsai. Great sprouting capacity and easy to model. Perfect for outdoors.',
                    ]
                ]
            ],
            [
                'datos_base' => [
                    'precio' => 85.90,
                    'stock' => 5,
                    'imagen_url' => 'images/ArceJapones.jpg',
                    'descuento_id' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                'traducciones' => [
                    [
                        'idioma' => 'es',
                        'nombre' => 'Bonsái Arce Japonés',
                        'descripcion' => 'Espectacular coloración otoñal en tonos rojos. Requiere protección del sol fuerte en verano.',
                    ],
                    [
                        'idioma' => 'en',
                        'nombre' => 'Japanese Maple Bonsai',
                        'descripcion' => 'Spectacular autumn coloring in red tones. Requires protection from strong sun in summer.',
                    ]
                ]
            ],
            [
                'datos_base' => [
                    'precio' => 120.00,
                    'stock' => 2,
                    'imagen_url' => 'images/PinoNegroJapones.jpg',
                    'descuento_id' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                'traducciones' => [
                    [
                        'idioma' => 'es',
                        'nombre' => 'Bonsái Pino Negro Japonés',
                        'descripcion' => 'Una joya para expertos. Árbol majestuoso de exterior que requiere técnicas de pinzado avanzadas.',
                    ],
                    [
                        'idioma' => 'en',
                        'nombre' => 'Japanese Black Pine Bonsai',
                        'descripcion' => 'A jewel for experts. Majestic outdoor tree that requires advanced pinching techniques.',
                    ]
                ]
            ]
        ];

        // Recorremos el array e insertamos en ambas tablas
        foreach ($productos as $item) {
            // 1. Insertamos en 'productos' y guardamos el ID generado
            $productoId = DB::table('productos')->insertGetId($item['datos_base']);

            // 2. Preparamos el array de traducciones con el ID del producto
            $traduccionesAInsertar = [];
            foreach ($item['traducciones'] as $traduccion) {
                $traduccionesAInsertar[] = [
                    'producto_id' => $productoId,
                    'idioma' => $traduccion['idioma'],
                    'nombre' => $traduccion['nombre'],
                    'descripcion' => $traduccion['descripcion'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            // 3. Insertamos todas las traducciones de este producto de golpe
            DB::table('productos_traducciones')->insert($traduccionesAInsertar);
        }
    }
}
