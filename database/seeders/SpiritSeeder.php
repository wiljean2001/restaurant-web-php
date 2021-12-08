<?php

namespace Database\Seeders;

use App\Models\Spirit;
use Illuminate\Database\Seeder;

class SpiritSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Spirit::factory(50)->create();
        Spirit::create([
            'name' => 'Vino tinto reserva 750ML',
            'price' => 40,
            'description' => 'Vino tinto LAN - botella reserva 750ML',
            'stock' => 130
        ]);
        Spirit::create([
            'name' => 'Pisco Quebranta 750ML',
            'price' => 29.90,
            'description' => 'Pisco Santiago-Queirolo UN 750ML',
            'stock' => 100
        ]);

        Spirit::create([
            'name' => 'Seagrams Gin',
            'description' => 'Seagrams Gin Seagrams Gin es una combinación magistral de botánicos, entre los cuales se encuentran bayas de enebro, naranja dulce y amarga cilantro y raíz de angélica.',
            'price' => 60.00,
            'stock' => 60
        ]);

        Spirit::create([
            'name' => 'Havana Club 7 Años',
            'description' => 'Los rones que lo componen han envejecido de 7 a 14 años, y parte de cada mezcla se vuelve a poner en barricas para su envejecimiento con vistas a posteriores producciones.',
            'price' => 80.00,
            'stock' => 50
        ]);

        Spirit::create([
            'name' => 'Licor de Hierbas Ruavieja',
            'description' => 'Licor de Hierbas Ruavieja es un licor elaborado con hierbas seleccionadas maceradas en aguardiente. ',
            'price' => 32.00,
            'stock' => 100
        ]);

        Spirit::create([
            'name' => 'Jägermeister',
            'description' => 'Licor que tiene un 35 % de contenido alcohólico. Se elabora con hierbas y es muy popular en toda Europa. En España lleva un par de años en continuo auge.',
            'price' => 45.00,
            'stock' => 85
        ]);

        Spirit::create([
            'name' => 'Baileys',
            'description' => 'Baileys fue el primer licor en combinar crema y alcohol de una manera lo suficientemente estable',
            'price' => 56.00,
            'stock' => 90
        ]);

        Spirit::create([
            'name' => 'Khlibniy',
            'description' => 'Utilizando agua extraída de las profundidades de Cherkass, el vodka ucraniano Khlibnyi Dar usa una mezcla de grano 100 % ecológico madurado al sol como base para producir este destilado. ',
            'price' => 60.00,
            'stock' => 100
        ]);

        Spirit::create([
            'name' => 'Jack Daniels',
            'description' => 'Filtrado en carbón de arce sacarino, dándole un sabor y aroma distintivos, la marca de Tennessee es una de las más vendidas del mundo. Conocida por sus botellas cuadradas y su etiqueta negra.',
            'price' => 55.00,
            'stock' => 150
        ]);

        Spirit::create([
            'name' => 'Absolut',
            'description' => 'Tipo de vodka de origen sueco. De gran importancia en EE.UU. donde el 20% del vodka importado allí es Absolut',
            'price' => 70.00,
            'stock' => 55
        ]);

        Spirit::create([
            'name' => 'Captain Morgan',
            'description' => 'Recibe este nombre por el corsario del Caribe del siglo XVII originario de Gales, Sir Henry Morgan.',
            'price' => 75.00,
            'stock' => 60
        ]);
        Spirit::create([
            'name' => 'Red Star Er Guo',
            'description' => 'También conocido como licor blanco chino y vodka de China, es una bebida alcohólica china.',
            'price' => 90.00,
            'stock' => 40
        ]);
    }
}
