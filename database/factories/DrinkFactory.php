<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DrinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombre = $this->faker->sentence(2, false);
        $nombre = Str::replaceLast('.', '', $nombre);
        $description = $this->faker->sentence(20, false);
        $description = Str::replaceLast('.', '', $nombre);
        return [
            'name' => $nombre,
            'price' => $this->faker->randomFloat(2, 10, 300),
            'description' => $description,
            // 'image' => $this->faker->image(public_path('files/drinks'), 640, 480, 'drinks', false, true),
            'stock' => $this->faker->randomFloat(0, 1, 500),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
