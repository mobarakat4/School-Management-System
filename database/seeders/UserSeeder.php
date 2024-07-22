<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user  = new User;
        $user->create([
            'name'=>'Admin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('123'),
            'role'=>'admin',
            'status'=>'active',
        ]);

        Admin::create([
            'user_id'=>1
        ]);


        $user  = new User;
        $user->create([
            'name'=>'Teacher',
            'username'=>'teacher',
            'email'=>'teacher@gmail.com',
            'password'=>Hash::make('123'),
            'role'=>'teacher',
            'status'=>'active',
        ]);

        Teacher::create([
            'user_id'=>2,
            'hired_by'=>1
        ]);
        $user  = new User;
        $user->create([
            'name'=>'Student',
            'username'=>'student',
            'email'=>'student@gmail.com',
            'password'=>Hash::make('123'),
            'role'=>'student',
            'status'=>'active',
        ]);


        Student::create([
            'user_id'=>3,
            'enrolled_by'=>1
        ]);

        $user  = new User;
        $user->create([
            'name'=>'Admin2',
            'username'=>'admin2',
            'email'=>'admin2@gmail.com',
            'password'=>Hash::make('123'),
            'role'=>'admin',
            'status'=>'active',
        ]);
        $user->address()->create([
            'address'=>"2th street",
            'city' => "giza",
        ]);
        Admin::create([
            'user_id'=>4,
            'added_by'=>1
        ]);

    }
}

