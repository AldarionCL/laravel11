<?php

namespace Database\Seeders;

use App\Models\Ticket\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory()->count(500)->create();
    }
}
