<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Account',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'Tegar Dito Priandika',
            'email' => 'tegar@gmail.com',
            'role_id' => 2,
        ]);
        User::factory()->create([
            'name' => 'Aisyatul Huriyah',
            'email' => 'aisyatul@gmail.com',
            'role_id' => 2,
        ]);
        User::factory()->create([
            'name' => 'Samsul Indonesia',
            'email' => 'samsul@gmail.com',
            'role_id' => 3,
        ]);
        User::factory()->create([
            'name' => 'Meera Savina',
            'email' => 'meera@gmail.com',
            'role_id' => 3,
        ]);
        User::factory()->create([
            'name' => 'Widyan sotya',
            'email' => 'widyan@gmail.com',
            'role_id' => 3,
        ]);

        User::factory(5)->create([
            'role_id' => 2,
        ]);
    }
}
