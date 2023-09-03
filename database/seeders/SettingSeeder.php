<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title'=>'Lesson Video Price',
                'column_name'=>'lesson_price',
                'column_type'=>'float',
                'value'=>10
            ],
            [
                'title'=>'Home Page Video Views',
                'column_name'=>'home_views',
                'column_type'=>'number',
                'value'=>0
            ]
        ];
        foreach ($data as $value) {
            Setting::firstOrCreate([
                'column_name'=>$value['column_name']
            ],$value);
        }
    }
}
