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
            'id' => 1,
            'fullname' => 'J.K Rowling'
        ]);

        DB::table('authors')->insert([
            'id' => 2,
            'fullname' => 'Dzonas Valanciunas'
        ]);

        DB::table('authors')->insert([
            'id' => 3,
            'fullname' => 'Lazauskiene'
        ]);

        DB::table('authors')->insert([
            'id' => 4,
            'fullname' => 'Mark Hanson'
        ]);

        DB::table('authors')->insert([
            'id' => 5,
            'fullname' => 'Baudejas'
        ]);

        DB::table('authors')->insert([
            'id' => 6,
            'fullname' => 'Oleg Surajev'
        ]);

        for($i=1;$i<30;$i++){
            $random_author= rand(2,6);

            DB::table('author_book')->insert([
                'book_id' => $i,
                'author_id' => $random_author
            ]);

            DB::table('author_book')->insert([
                'book_id' => $i,
                'author_id' => $random_author-1
            ]);

        }

    }
}
