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
                . 'Cuenta la historia que este plato ya se consumía en la época precolombina.',
            'stock' => '50'
        ]);
        Dish::create([
            'name' => 'Cabrito',
            'price' => '22.00',
            'description' => 'Plato tradicional, en general su contenido es la presa del Cabrito, acompañado de arroz blanco , frijol y yuca.',
            'stock' => '10'
        ]);
        Dish::create([
            'name' => 'Cuy Frito',
            'price' => '23.00',
            'description' => 'Plato personal, que se acompaña con Arroz Blanco, tringo mote, ajiaco y su sarsa criolla.',
            'stock' => '13'
        ]);
        Dish::create([
            'name' => 'Sopa teologa',
            'price' => '25.00',
            'description' => 'Plato tradicional , su contenido es pepian  acompañado de presas como pavo sancochado, Cabrito, azafrán,  garbanzos y una rosca de manteca.',
            'stock' => '11'
        ]);
        Dish::create([
            'name' => 'Pepián de pava',
            'price' => '25.00',
            'description' => 'Pipian de arroz o maíz acompañado de una presa de pava.',
            'stock' => '15'
        ]);
        Dish::create([
            'name' => 'Pachamanca',
            'price' => '35.00',
            'description' => 'Plato tradicional su contenido es de una presa de pollo, de cerdo, camotes asados, habas, humas y oca.',
            'stock' => '14'
        ]);
        Dish::create([
            'name' => 'Ceviche De Caballa',
            'price' => '16.00',
            'description' => 'Hecho a base de Caballa salpreso , acompañado de guarniciones como son la yuca, sarandaja,  camote, choclo y lechuga.',
            'stock' => '17'
        ]);
        Dish::create([
            'name' => 'Chicharrones de Pescado',
            'price' => '23.00',
            'description' => 'Pequeños recortes fritos de pescado acompañado de yucas fritas y ensalada.',
            'stock' => '18'
        ]);
        Dish::create([
            'name' => 'Chicharrones de Pollo',
            'price' => '20.00',
            'description' => 'Pequeños recortes de pollo fritos, acompañado de yucas fritos y ensalada.',
            'stock' => '18'
        ]);
        Dish::create([
            'name' => 'Chicharrones de Chancho',
            'price' => '15.00',
            'description' => 'Pequeños recortes de chancho Frito, acompañado de mote, sarsa criolla y ensalada.',
            'stock' => '13'
        ]);
        Dish::create([
            'name' => 'Sudado de Pescado',
            'price' => '25.00',
            'description' => 'Pescado hecho al punto de Sudado con recortes de cebollas y tomates, acompañado de guarniciones como yuca y camote.',
            'stock' => '11'
        ]);
        Dish::create([
            'name' => 'Pescado Frito',
            'price' => '25.00',
            'description' => 'Pescado al punto de frito, acompañado de guarnicionescomo yuca, limón y ensalada.',
            'stock' => '10'
        ]);
        Dish::create([
            'name' => 'Raya Sancochada',
            'price' => '16.00',
            'description' => 'Recortes de Raya al punto de sancochado, acompañado de sarsa criolla, yuca y camote.',
            'stock' => '13'
        ]);
        Dish::create([
            'name' => 'Raya Guisada',
            'price' => '18.00',
            'description' => 'Recortes de Raya al punto de guisado,acompañado de guarniciones como yuca, camote y limon.',
            'stock' => '12'
        ]);
    }
}
