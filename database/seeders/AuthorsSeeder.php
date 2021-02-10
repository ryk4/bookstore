<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
            'fullname' => 'J.K Rowling'
        ]);

        DB::table('authors')->insert([
            'fullname' => 'Neil Murray'
        ]);

        DB::table('author_book')->insert([
            'book_id' => 1,
            'author_id' => 1
        ]);

        DB::table('author_book')->insert([
            'book_id' => 1,
            'author_id' => 2
        ]);

    }
}
