<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Luciana Morales',
            'email' => 'lu-admin@example.com',
            'password' => bcrypt('11111111'),
        ]);

        User::factory(20)->create();
        Category::factory(5)->create();
        Post::factory(100)->create();
        
        $this->call(TagSeeder::class);
    }
}
