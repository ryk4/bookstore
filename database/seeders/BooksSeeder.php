<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
Use DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'id' => 1,
            'title' => 'Harry Potter and the Philosophers Stone',
            'cover' => 'harry1',
            'price' => 12,
            'discount' => 0,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => 1
        ]);

        DB::table('books')->insert([
            'id' => 2,
            'title' => 'Harry Potter and the Secret Chaimber',
            'cover' => 'haris2',
            'price' => 18,
            'discount' => 10,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => 1
        ]);
    }
}
