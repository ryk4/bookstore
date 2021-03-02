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
            'id' => 1,
            'name' => 'Fantasy',
        ]);

        DB::table('genres')->insert([
            'id' => 2,
            'name' => 'Drama',
        ]);

        DB::table('genres')->insert([
            'id' => 3,
            'name' => 'Classic',
        ]);

        DB::table('genres')->insert([
            'id' => 4,
            'name' => 'Horror',
        ]);

        DB::table('genres')->insert([
            'id' => 5,
            'name' => 'Romance',
        ]);

        DB::table('genres')->insert([
            'id' => 6,
            'name' => 'History',
        ]);


        for($i=1;$i<30;$i++){
            $random_author= rand(2,6);

            DB::table('book_genre')->insert([
                'book_id' => $i,
                'genre_id' => $random_author
            ]);

            DB::table('book_genre')->insert([
                'book_id' => $i,
                'genre_id' => $random_author-1
            ]);

        }
    }
}
