<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            'firstname' => 'Joanne',
            'lastname' => 'Rowling'
        ]);


        DB::table('books_authors')->insert([
            'book_id' => 1,
            'author_id' => 1
        ]);

    }
}
