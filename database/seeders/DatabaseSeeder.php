<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DishSeeder::class);
        $this->call(DrinkSeeder::class);
        $this->call(SpiritSeeder::class);
        $this->call(TableSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
