<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grade_levels')->insert([
            [
                'level'=>'1st',
                'start_year'=>2024,
                'end_year'=>2025,
            ],
            [
                'level'=>'2st',
                'start_year'=>2024,
                'end_year'=>2025,
            ],
            [
                'level'=>'3st',
                'start_year'=>2024,
                'end_year'=>2025,
            ],
        ]
        );
    }
}
