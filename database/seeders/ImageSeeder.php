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
            'url' => '\img\dishes\arroz_con_pollo.jpeg',
            'imageable_id' => '1',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\causa_rellena_limena.webp',
            'imageable_id' => '2',
            'imageable_type' => 'App\Models\Dish'
        ]);

        Image::create([
            'url' => '\img\drinks\gatorade_botella_500ML.jpg',
            'imageable_id' => '1',
            'imageable_type' => 'App\Models\Drink'
        ]);
        Image::create([
            'url' => '\img\drinks\sprite_lata_335ML.jpg',
            'imageable_id' => '2',
            'imageable_type' => 'App\Models\Drink'
        ]);

        Image::create([
            'url' => '\img\spirits\vino_tinto_reserva_750ML.jpg',
            'imageable_id' => '1',
            'imageable_type' => 'App\Models\Spirit'
        ]);
        Image::create([
            'url' => '\img\spirits\pisco_quebranta750ML.jpg',
            'imageable_id' => '2',
            'imageable_type' => 'App\Models\Spirit'
        ]);
    }
}
