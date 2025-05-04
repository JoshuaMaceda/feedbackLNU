<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $primaryKey = 'teacher_id'; // Explicitly setting the primary key
    public $incrementing = false; // If IDs are manually assigned and not auto-incrementing
    protected $keyType = 'bigint'; // Match with database definition
    protected $guarded = []; // Allows all fields for admin-driven creation

    /**
     * Get the full name of the teacher.
     * 
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get all courses taught by this teacher.
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id', 'teacher_id');
    }

    /**
     * Get all feedback received by this teacher.
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'teacher_id', 'teacher_id');
    }

    /**
     * Get all students enrolled in this teacher's courses.
     */
    public function students()
    {
        return $this->hasManyThrough(
            Student::class, 
            Enrollment::class,
            'course_id',        // Foreign key in enrollments linking to courses
            'student_id',       // Foreign key in students table
            'teacher_id',       // Primary key in courses table (not teachers!)
            'student_id'        // Foreign key in enrollments table linking to students
        );
    }
}
