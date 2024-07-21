<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user->address()->create([]);
        $user->admin()->create(['user_id'=>2]);
        // $user->address()->address = "address";
        // $user->address()->city = "cairo";
        // $user->save();

        // DB::table('users')->insert([
        //     'name'=>'Teacher',
        //     'username'=>'teacher',
        //     'email'=>'teacher@gmail.com',
        //     'password'=>Hash::make('123'),
        //     'role'=>'teacher',
        //     'status'=>'active',
        // ]);
        // DB::table('users')->insert([
        //     'name'=>'Student',
        //     'username'=>'student',
        //     'email'=>'student@gmail.com',
        //     'password'=>Hash::make('123'),
        //     'role'=>'student',
        //     'status'=>'active',
        // ]);
    }
}
