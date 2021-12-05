<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::create([
            'url' => '\img\dish\arroz_con_pato.png',
            'imageable_id' => '1',
            'imageable_type' => 'App\Model\Dish'
        ]);
        Image::create([
            'url' => '\dish\arroz_con_pollo.png',
            'imageable_id' => '2',
            'imageable_type' => 'App\Model\Dish'
        ]);
    }
}
