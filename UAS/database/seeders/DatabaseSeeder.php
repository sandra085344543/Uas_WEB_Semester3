<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Musik;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\MovieSeeder;
use Database\Factories\MovieFactory;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //seeder
        $this->call(CategorySeeder::class);
        $this->call(MusikSeeder::class);
        $this->call(UserSeeder::class);
    }
}
