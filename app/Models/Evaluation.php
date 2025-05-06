<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Changed to match the migration
    protected $guarded = []; // Allows all fields for admin-driven creation

    /**
     * Get the student who submitted this feedback.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'evaluator_id', 'user_id');
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
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * Get the score related to this evaluation
     */
    public function score()
    {
        return $this->belongsTo(Score::class);
    }
}