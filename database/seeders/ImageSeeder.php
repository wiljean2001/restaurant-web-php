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
        // DISHES
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
            'url' => '\img\dishes\cabrito.jpg',
            'imageable_id' => '3',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\cuy-frito.jpg',
            'imageable_id' => '4',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\sopa-teologa.jpg',
            'imageable_id' => '5',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\pepián-de-pava.jpg',
            'imageable_id' => '6',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\pachamanca.jpg',
            'imageable_id' => '7',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\ceviche-de-caballa.jpg',
            'imageable_id' => '8',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\chicharrones-de-pescado.jpg',
            'imageable_id' => '9',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\chicharrones-de-pollo.jpg',
            'imageable_id' => '10',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\chicharrones-de-chancho.jpg',
            'imageable_id' => '11',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\sudado-de-pescado.jpg',
            'imageable_id' => '12',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\pescado-frito.jpg',
            'imageable_id' => '13',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\raya-sancochada.jpg',
            'imageable_id' => '14',
            'imageable_type' => 'App\Models\Dish'
        ]);
        Image::create([
            'url' => '\img\dishes\raya-guisada.jpg',
            'imageable_id' => '15',
            'imageable_type' => 'App\Models\Dish'
        ]);

        // DRINKS
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

        // SPIRITS
        // Image::create([
        //     'url' => '\img\spirits\vino_tinto_reserva_750ML.jpg',
        //     'imageable_id' => '1',
        //     'imageable_type' => 'App\Models\Spirit'
        // ]);
        // Image::create([
        //     'url' => '\img\spirits\pisco_quebranta750ML.jpg',
        //     'imageable_id' => '2',
        //     'imageable_type' => 'App\Models\Spirit'
        // ]);
    }
}
