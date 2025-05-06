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
        
        // Fixed to match the correct foreign keys and table schema
        return Evaluation::where('evaluator_id', $student->user_id)
                         ->where('course_id', $course->id) // Using course id instead of course_id
                         ->where('teacher_id', $course->teacher_id)
                         ->exists();
    }
}