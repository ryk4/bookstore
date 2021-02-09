<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'name' => 'Fantasy',
        ]);

        DB::table('genres')->insert([
            'name' => 'Drama',
        ]);

        DB::table('genres')->insert([
            'name' => 'Classic',
        ]);

        DB::table('genres')->insert([
            'name' => 'Horror',
        ]);

        DB::table('genres')->insert([
            'name' => 'Romance',
        ]);

        DB::table('books_genres')->insert([
            'book_id' => 1,
            'genre_id' => 1
        ]);

        DB::table('books_genres')->insert([
            'book_id' => 1,
            'genre_id' => 2
        ]);
    }
}
