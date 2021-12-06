<?php

namespace Database\Seeders;

use App\Models\Image;
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
        $this->call(UserSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(WaiterSeeder::class);
    }
}
