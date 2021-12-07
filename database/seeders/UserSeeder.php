<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // assignRole('admin'),
        User::create(
            [
                'name' => 'Pedro Azabache Cruz',
                'email' => 'admin_pedro@piedrascalientes.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        )->assignRole('publisher');

        User::create(
            [
                'name' => 'Wilmer Ayala García',
                'email' => 'root-admin_wiljean@piedrascalientes.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        )->assignRole('admin');
    }
}
