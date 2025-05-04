<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;


class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::create([
            'id' => 1, // Using 'id' instead of 'course_id'
            'course_name' => 'Algebra',
            'course_code' => 'MATH101',
            'teacher_id' => 1, // Matches TeacherSeeder user_id
            'semester' => 'First',
            'section' => 'A',
            'year' => '2025',
        ]);

        Course::create([
            'id' => 2,
            'course_name' => 'Biology',
            'course_code' => 'SCI102',
            'teacher_id' => 2,
            'semester' => 'First',
            'section' => 'B',
            'year' => '2025',
        ]);
    }
}
