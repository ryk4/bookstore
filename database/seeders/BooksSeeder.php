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
            'description' => 'HarLorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum',
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

        DB::table('books')->insert([
            'id' => 3,
            'title' => 'Harry Potter and thirdr',
            'cover' => 'haris2',
            'price' => 18.00,
            'discount' => 10,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => 1
        ]);

        DB::table('books')->insert([
            'id' => 4,
            'title' => 'Harry Potter and the fourth',
            'cover' => 'cover',
            'price' => 11.50,
            'discount' => 10,
            'status' => 0,
            'created_at' => Carbon::now()->add(-7,'day'),
            'updated_at' => Carbon::now(),
            'user_id' => 1
        ]);

        DB::table('books')->insert([
            'id' => 5,
            'title' => 'Harry Potter and the fifth',
            'cover' => 'cover',
            'price' => 18.05,
            'discount' => 15,
            'status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => 1
        ]);
    }
}
