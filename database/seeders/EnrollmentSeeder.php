<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        Enrollment::create([
            'id' => 1,
            'student_id' => 1, // Matches StudentSeeder
            'course_id' => 1,  // Matches CourseSeeder
            'teacher_id' => 1, // Fixed: Matches teachers table!
        ]);

        Enrollment::create([
            'id' => 2,
            'student_id' => 2, // Another student
            'course_id' => 2,  // Another course
            'teacher_id' => 2, // Fixed: Correct teacher_id
        ]);
    }
}
