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
            'id' => 1,
            'name' => 'Admin test',
            'email' => 'admin@admin.com',
            'dob' => '2000-02-10',
            'user_level' =>  0,
            'password' => Hash::make('Test123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Normal user test',
            'email' => 'normal@normal.com',
            'dob' => '2001-02-10',
            'user_level' =>  1,
            'password' => Hash::make('Test123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
