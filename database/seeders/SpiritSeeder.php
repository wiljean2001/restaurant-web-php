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
    }
}
