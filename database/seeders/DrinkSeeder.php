<?php

namespace Database\Seeders;

use App\Models\Drink;
use Illuminate\Database\Seeder;

class DrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drink::factory(50)->create();
        Drink::create([
            'name' => 'Gatorade - botella 500ML',
            'price' => 2,
            'description' => 'Bebida rehidratante sabor mandarina botella 500 ML ',
            'stock' => 100
        ]);
        Drink::create([
            'name' => 'Sprite - lata 335ML',
            'price' => 5.3,
            'description' => 'Gaseosa sabor regular lata 355ML',
            'stock' => 50
        ]);
    }
}
