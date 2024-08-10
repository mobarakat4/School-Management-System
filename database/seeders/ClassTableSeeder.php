<?php

namespace Database\Seeders;

use App\Models\Classname;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [// add some classes
            ['class_name'=>'1/1','grade_year'=>1],
            ['class_name'=>'1/2','grade_year'=>1],
            ['class_name'=>'1/3','grade_year'=>1],
            ['class_name'=>'2/1','grade_year'=>2],
            ['class_name'=>'3/1','grade_year'=>3],
        ];
        Classname::insert($data);
    }
}
