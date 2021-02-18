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

        DB::table('genres')->insert([
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
