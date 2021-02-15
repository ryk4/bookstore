<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'actual_review' => 'I aint no wizard, so cant really rate this.',
            'created_at' => Carbon::now(),
            'user_id' => 1,
            'book_id' => 1
        ]);

        DB::table('reviews')->insert([
            'actual_review' => 'This book looking kinda THICCCCCCCC.',
            'created_at' => Carbon::now(),
            'user_id' => 1,
            'book_id' => 1
        ]);

    }
}
