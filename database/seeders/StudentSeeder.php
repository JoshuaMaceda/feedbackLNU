<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::create([
            'student_id' => 1,
            'user_id' => 1,
            'first_name' => 'John',
            'middle_name' => 'D.',
            'last_name' => 'Doe',
            'section' => 'A',
            'school_year' => '2025',
        ]);

        Student::create([
            'student_id' => 2,
            'user_id' => 2,
            'first_name' => 'Jane',
            'middle_name' => 'M.',
            'last_name' => 'Smith',
            'section' => 'B',
            'school_year' => '2025',
        ]);
    }
}
