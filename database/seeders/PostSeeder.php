<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        Post::factory(20)->create([
            'user_id' => $users->random()->id,
            'is_approved' => fake(),
        ]);
    }
}
