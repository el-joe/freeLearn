<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('users')->where('email','mr.architecture.92@gmail.com')->exists()) return false;

        DB::table('users')->insert([
            'name'=> 'Super Admin',
            'email'=> 'mr.architecture.92@gmail.com',
            'password'=> bcrypt('M123789M'),
            'role'=> 'admin'
        ]);
    }
}
