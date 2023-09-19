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
                'value'=>10,
                'slug'=>'general'
            ],
            [
                'title'=>'Home Page Video Views',
                'column_name'=>'home_views',
                'column_type'=>'number',
                'value'=>0,
                'slug'=>'home'
            ],
            [
                'title'=>'Home Page National Section',
                'column_name'=>'home_nat_sec',
                'column_type'=>'array',
                'value'=> NULL,
                'slug'=>'home'
            ],
            [
                'title'=>'Home Page International Section',
                'column_name'=>'home_internat_sec',
                'column_type'=>'array',
                'value'=> NULL,
                'slug'=>'home'
            ],
            [
                'title'=>'Home Page Course Section',
                'column_name'=>'home_course_sec',
                'column_type'=>'array',
                'value'=> NULL,
                'slug'=>'home'
            ],
            [
                'title'=>'Terms & Conditions',
                'column_name'=>'terms_content',
                'column_type'=>'textarea',
                'value'=> NULL,
                'slug'=>'terms'
            ]
        ];
        foreach ($data as $value) {
            Setting::firstOrCreate([
                'column_name'=>$value['column_name']
            ],$value);
        }
    }
}
