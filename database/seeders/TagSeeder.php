<?php

namespace Database\Seeders;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tags = ['laravel', 'vue', 'react'];

        foreach ($tags as $tag) {
            \App\Models\Tag::create([
                'name' => $tag,
            ]);
        }
    }
}
