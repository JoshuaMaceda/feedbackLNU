<?php

use Illuminate\Database\Seeder;
use App\Models\Evaluation;

class EvaluationSeeder extends Seeder
{
    public function run()
    {
        Evaluation::create([
            'student_id' => 1,  // Change based on your data
            'course_id' => 1,
            'teacher_id' => 1,
            'score_id' => 5,
            'evaluation_type' => 'Final',
            'school_year' => '2024-2025',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
