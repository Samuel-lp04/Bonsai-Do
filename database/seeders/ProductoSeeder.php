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

        $catInteriorId = DB::table('categorias')->insertGetId([]);
        DB::table('categorias_traducciones')->insert([
            ['categoria_id' => $catInteriorId, 'idioma' => 'es', 'nombre' => 'Bonsái de Interior', 'descripcion' => 'Especies que se adaptan bien a las condiciones climáticas del interior del hogar.'],
            ['categoria_id' => $catInteriorId, 'idioma' => 'en', 'nombre' => 'Indoor Bonsai', 'descripcion' => 'Species that adapt well to indoor climatic conditions.']
        ]);

        $catExteriorId = DB::table('categorias')->insertGetId([]);
        DB::table('categorias_traducciones')->insert([
            ['categoria_id' => $catExteriorId, 'idioma' => 'es', 'nombre' => 'Bonsái de Exterior', 'descripcion' => 'Especies que necesitan sentir el paso de las estaciones, el sol y el viento.'],
            ['categoria_id' => $catExteriorId, 'idioma' => 'en', 'nombre' => 'Outdoor Bonsai', 'descripcion' => 'Species that need to feel the changing seasons, sun, and wind.']
        ]);

        $catOmonoId = DB::table('categorias')->insertGetId([]);
        DB::table('categorias_traducciones')->insert([
            ['categoria_id' => $catOmonoId, 'idioma' => 'es', 'nombre' => 'Bonsái Omono', 'descripcion' => 'Bonsáis de tamaño grande, generalmente requieren cuatro manos para ser movidos.'],
            ['categoria_id' => $catOmonoId, 'idioma' => 'en', 'nombre' => 'Omono Bonsai', 'descripcion' => 'Large sized bonsais, generally requiring four hands to be moved.']
        ]);

        $productos = [
            [
                'datos_base' => [
                    'precio' => 45.50,
                    'stock' => 15,
                    'imagen_url' => 'images/FicusRetusa.jpg',
                    'descuento_id' => null,
                ],
                'categorias' => [$catInteriorId],
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
                ],
                'categorias' => [$catExteriorId],
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
                ],
                'categorias' => [$catExteriorId],
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
                ],
                'categorias' => [$catExteriorId, $catOmonoId],
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

        foreach ($productos as $item) {
            $productoId = DB::table('productos')->insertGetId($item['datos_base']);

            $traduccionesAInsertar = [];
            foreach ($item['traducciones'] as $traduccion) {
                $traduccionesAInsertar[] = [
                    'producto_id' => $productoId,
                    'idioma' => $traduccion['idioma'],
                    'nombre' => $traduccion['nombre'],
                    'descripcion' => $traduccion['descripcion'],
                ];
            }

            DB::table('productos_traducciones')->insert($traduccionesAInsertar);
            
            foreach ($item['categorias'] as $catId) {
                DB::table('categoria_producto')->insert([
                    'producto_id' => $productoId,
                    'categoria_id' => $catId
                ]);
            }
        }
    }
}
