<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [// add some classes
            ['name'=>'English'],
            ['name'=>'Arbic'],
            ['name'=>'math'],
        ];
        Subject::insert($data);
    }
}
