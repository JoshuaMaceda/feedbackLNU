<?php

use Illuminate\Database\Seeder;
use App\Models\Evaluation;

class EvaluationSeeder extends Seeder
{
    public function run()
    {
        Evaluation::create([
            'student_id' => 1,
            'course_id' => 1,
            'rating' => 5,
            'comments' => 'Great course!',
        ]);
    }
}
