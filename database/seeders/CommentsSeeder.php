<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'actual_comment' => 'I aint no wizard, so cant really rate this.',
            'created_at' => Carbon::now(),
            'user_id' => 1,
            'book_id' => 1
        ]);

        DB::table('comments')->insert([
            'actual_comment' => 'This book looking kinda THICCCCCCCC.',
            'created_at' => Carbon::now(),
            'user_id' => 1,
            'book_id' => 1
        ]);

    }
}
