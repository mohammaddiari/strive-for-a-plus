<?php

namespace Database\Seeders;

use App\Models\Post;
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
        User::factory()->create([
            'name' => 'Mohammed',
            'email' => 'mohammed@yopmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $users = User::factory(10)->create();
        Post::factory(50)->recycle($users)->create();
    }
}
