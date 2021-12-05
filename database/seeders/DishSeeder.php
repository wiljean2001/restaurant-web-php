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
            'name ' => 'Arroz con pato',
            'price' => '30.00',
            'description' => 'Plato personal ...',
            'stock' => '10'
        ]);
        Dish::create([
            'name ' => 'Arroz con pollo',
            'price' => '30.00',
            'description' => 'Plato personal ...',
            'stock' => '10'
        ]);
        Dish::create([
            'name ' => 'Seco de cabrito',
            'price' => '30.00',
            'description' => 'Plato personal ...',
            'stock' => '10'
        ]);
        Dish::create([
            'name ' => 'Ceviche',
            'price' => '30.00',
            'description' => 'Plato personal ...',
            'stock' => '10'
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
