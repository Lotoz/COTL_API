<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Follower;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear a Lamb
        $lamb = User::create([
            'name' => 'The Lamb',
            'email' => 'lamb@cult.com',
            'password' => Hash::make('password123'),
        ]);

        // Crear a Goat
        $goat = User::create([
            'name' => 'The Goat',
            'email' => 'goat@cult.com',
            'password' => Hash::make('password123'),
        ]);

        // Seguidores para Lamb (Inicia con Narinder)
        $lamb->followers()->createMany([
            ['name' => 'Narinder', 'species' => 'Cat', 'level' => 10, 'loyalty_points' => 100, 'is_elderly' => false, 'joined_at' => '2024-01-01'],
            ['name' => 'Valefar', 'species' => 'Deer', 'level' => 3, 'loyalty_points' => 20, 'is_elderly' => false, 'joined_at' => '2024-01-10'],
            ['name' => 'Barbatos', 'species' => 'Pig', 'level' => 5, 'loyalty_points' => 45, 'is_elderly' => true, 'joined_at' => '2024-01-15'],
            ['name' => 'Kallamar_Minion', 'species' => 'Squid', 'level' => 2, 'loyalty_points' => 10, 'is_elderly' => false, 'joined_at' => '2024-02-01'],
            ['name' => 'Heket_Spawn', 'species' => 'Frog', 'level' => 4, 'loyalty_points' => 30, 'is_elderly' => false, 'joined_at' => '2024-02-05'],
            ['name' => 'Fenrys', 'species' => 'Wolf', 'level' => 1, 'loyalty_points' => 5, 'is_elderly' => false, 'joined_at' => '2024-02-10'],
        ]);

        // Seguidores para Goat (Inicia con Shamura)
        $goat->followers()->createMany([
            ['name' => 'Shamura', 'species' => 'Spider', 'level' => 10, 'loyalty_points' => 100, 'is_elderly' => false, 'joined_at' => '2024-01-01'],
            ['name' => 'Amon', 'species' => 'Dog', 'level' => 6, 'loyalty_points' => 55, 'is_elderly' => false, 'joined_at' => '2024-01-12'],
            ['name' => 'Leraje', 'species' => 'Rabbit', 'level' => 3, 'loyalty_points' => 25, 'is_elderly' => true, 'joined_at' => '2024-01-20'],
            ['name' => 'Ipos', 'species' => 'Bird', 'level' => 2, 'loyalty_points' => 15, 'is_elderly' => false, 'joined_at' => '2024-01-25'],
            ['name' => 'Haborym', 'species' => 'Crocodile', 'level' => 7, 'loyalty_points' => 80, 'is_elderly' => false, 'joined_at' => '2024-02-02'],
            ['name' => 'Zepar', 'species' => 'Fennec', 'level' => 4, 'loyalty_points' => 35, 'is_elderly' => false, 'joined_at' => '2024-02-08'],
        ]);
    }
}
