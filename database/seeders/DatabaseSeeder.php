<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Database\Factories\CategoryFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
                    UserSeeder::class,
                    CategorySeeder::class,
                    ProductSeeder::class,
                    RoleSeeder::class]);
        $users = User::factory(10)->create();

        Category::factory(20)->create([

        ]);
    }
}
