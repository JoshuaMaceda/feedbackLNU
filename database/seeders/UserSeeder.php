<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create student users
        User::create([
            'id' => 1,
            'username' => 'student_john',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);

        User::create([
            'id' => 2,
            'username' => 'student_jane',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);

        // Create teacher users
        User::create([
            'id' => 5, // Must match TeacherSeeder user_id
            'username' => 'teacher_jane',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
        ]);

        User::create([
            'id' => 6, // Must match TeacherSeeder user_id
            'username' => 'teacher_michael',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
        ]);
    }
}
