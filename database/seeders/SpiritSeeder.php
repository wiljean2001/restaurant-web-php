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
        Spirit::factory(50)->create();
    }
}
