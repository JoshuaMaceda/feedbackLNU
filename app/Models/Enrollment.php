<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Evaluation;

class Enrollment extends Model
{
    use HasFactory;

    protected $primaryKey = 'enrollment_id'; // Explicitly setting primary key
    public $incrementing = false; // If IDs are manually assigned and not auto-incrementing
    protected $keyType = 'bigint'; // Match database structure
    protected $guarded = []; // Allows all fields for admin-driven creation

    /**
     * Get the student associated with this enrollment.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'evaluator_id', 'id'); // Changed from student_id to evaluator_id
    }

    /**
     * Get the course associated with this enrollment.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * Get the teacher of this enrolled course.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    /**
     * Check if an evaluation has been submitted for this enrollment.
     * 
     * @return bool
     */
    public function hasEvaluation()
    {
        return Evaluation::where('evaluator_id', $this->evaluator_id) // Changed from student_id to evaluator_id
                         ->where('course_id', $this->course_id)
                         ->exists();
    }
}
