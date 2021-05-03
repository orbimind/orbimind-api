<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => "PAXANDDOS",
            'name' => "Paul",
            'email' => "pashalitovka" . '@gmail.com',
            'password' => Hash::make("paxanddos"),
        ]);
        DB::table('users')->insert([
            'username' => "Grandmaz",
            'name' => "Sanya",
            'email' => "lyannoy.alexander" . '@gmail.com',
            'password' => Hash::make("paxanddos"),
        ]);

        DB::table('categories')->insert([
            'title' => "PHP",
            'description' => "Pizdenko"
        ]);
        DB::table('categories')->insert([
            'title' => "JS",
            'description' => "Nice job oleg"
        ]);
        DB::table('categories')->insert([
            'title' => "HTML",
            'description' => "Nice job pavlo"
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => "Help",
            'content' => "Nice job pavlo",
            'category_id' => json_encode([2, 3])
        ]);
        DB::table('posts')->insert([
            'user_id' => 2,
            'title' => "Help me lol",
            'content' => "Nice job sanya",
            'category_id' => json_encode([1])
        ]);

        DB::table('comments')->insert([
            'user_id' => 1,
            'post_id' => 2,
            'content' => "Nice post"
        ]);
        DB::table('comments')->insert([
            'user_id' => 2,
            'post_id' => 2,
            'content' => "Very cool"
        ]);
        DB::table('comments')->insert([
            'user_id' => 2,
            'post_id' => 1,
            'content' => "Derletel post"
        ]);
        DB::table('comments')->insert([
            'user_id' => 1,
            'post_id' => 1,
            'content' => "Cringe post"
        ]);
    }
}
