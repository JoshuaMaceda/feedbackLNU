<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $primaryKey = 'feedback_id'; // Explicitly setting primary key
    public $incrementing = false; // If IDs are manually assigned and not auto-incrementing
    protected $keyType = 'bigint'; // Match database structure
    protected $guarded = []; // Allows all fields for admin-driven creation

    /**
     * Get the student who submitted this feedback.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    /**
     * Get the teacher this feedback is for.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }

    /**
     * Get the course this feedback is for.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    /**
     * Calculate the average rating across all questions.
     * 
     * @return float
     */
    public function getAverageRatingAttribute()
    {
        $ratings = [$this->professionalism, $this->commitment, $this->knowledge, 
                    $this->independent_learning, $this->management, $this->critical_factors];

        return round(array_sum($ratings) / count($ratings), 1);
    }
}
