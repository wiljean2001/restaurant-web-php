<?php

namespace Database\Seeders;

use App\Models\Waiter;
use Illuminate\Database\Seeder;

class WaiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Waiter::create([
            'dni' => '73889330',
            'name' => 'Wilmer',
            'lname' => 'Ayala García',
            'date_of_birth' => date('Y-m-d h:i:s'),
        ]);
    }
}
