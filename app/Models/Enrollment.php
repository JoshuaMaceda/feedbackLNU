<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Changed to match standard Laravel convention
    protected $guarded = [];

    /**
     * Get the student associated with this enrollment.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    /**
     * Get the course associated with this enrollment.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * Check if an evaluation has been submitted for this enrollment.
     * 
     * @return bool
     */
    public function hasEvaluation()
    {
        $student = $this->student;
        $course = $this->course;
        
        if (!$student || !$course) {
            return false;
        }
        
        // Fixed query to match how evaluations are stored
        // Check if the course_id field in evaluations table contains the course code 
        // (as it seems to be stored that way in the feedback form)
        return Evaluation::where('evaluator_id', $student->user_id)
                        ->where('course_id', $course->course_code) // Changed from $course->id to $course->course_code
                        ->where('teacher_id', $course->teacher_id)
                        ->exists();
    }
}