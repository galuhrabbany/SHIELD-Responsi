<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Galuh',
            'email' => 'galuhayucitarabbany2005@mail.ugm.ac.id',
            'password' => bcrypt('admin'),
        ]);

        User::factory()->create([
            'name' => 'galy',
            'email' => 'galuhrabbany@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
    }
}
