<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

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
            'name' => 'Meera Savina',
            'email' => 'meera@gmail.com',
            'role_id' => 3,
        ]);
        User::factory()->create([
            'name' => 'Widyan sotya',
            'email' => 'widyan@gmail.com',
            'role_id' => 3,
        ]);
    }
}
