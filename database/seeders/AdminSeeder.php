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
        if(DB::table('users')->where('email','admin@admin.com')->exists()) return false;

        DB::table('users')->insert([
            'name'=> 'Super Admin',
            'email'=> 'admin@admin.com',
            'password'=> bcrypt(123456)
        ]);
    }
}
