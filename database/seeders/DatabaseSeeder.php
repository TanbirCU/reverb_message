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
        // Create test users
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Sarah Smith',
            'email' => 'sarah@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Mike Johnson',
            'email' => 'mike@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Emma Wilson',
            'email' => 'emma@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Alex Brown',
            'email' => 'alex@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create additional random users
        User::factory(10)->create();
    }
}
