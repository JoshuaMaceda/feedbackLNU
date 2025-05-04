<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        Teacher::create([
            'teacher_id' => 1,
            'user_id' => 5, // Changed to avoid conflict with student 'Jane'
            'first_name' => 'Jane',
            'middle_name' => 'M.',
            'last_name' => 'Smith',
            'department' => 'Mathematics',
        ]);

        Teacher::create([
            'teacher_id' => 2,
            'user_id' => 6, // Unique user ID
            'first_name' => 'Michael',
            'middle_name' => 'J.',
            'last_name' => 'Brown',
            'department' => 'Science',
        ]);
    }
}
