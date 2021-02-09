<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'rytis klimavicius',
            'email' => 'rytiskli@gmail.com',
            'dob' => '2021-02-10',
            'password' => Hash::make('Test123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
