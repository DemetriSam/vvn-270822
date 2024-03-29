<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class TestPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()->count(40)->create();
    }
}
