<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dish::factory(50)->create();
        Dish::create([
            'name' => 'Arroz con pollo',
            'price' => '30.00',
            'description' => 'El Arroz con Pollo es un clásico de la cocina peruana '
                . 'de delicioso sabor gracias a culantro y con un aroma '
                . 'inconfundible capaz de despertar el apetito de muchos.',
            'stock' => '10'
        ]);
        Dish::create([
            'name' => 'Causa rellena de pollo',
            'price' => '35.00',
            'description' => 'Uno de los platos más tradicionales de la cocina peruana. '
                . 'Cuenta la historia que este plato ya se consumía en la época precolombina',
            'stock' => '50'
        ]);
        // 
        //         (`id`,
        // `name`,
        // `price`,
        // `description`,
        // `stock`,
        // `created_at`,
        // `updated_at`)
    }
}
