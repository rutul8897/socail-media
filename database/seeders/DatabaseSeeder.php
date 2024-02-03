<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Post;
use App\Models\PostImage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@softui.com',
            'password' => Hash::make('secret')
        ]);

         // Post::factory(10)->create();
         PostImage::factory(10)->create();
    }
}
