<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Student extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'student_id'; // Explicitly setting the primary key
    public $incrementing = false; // If IDs are manually assigned and not auto-incrementing
    protected $keyType = 'bigint'; // Match database structure
    protected $guarded = []; // Allows all fields for admin-driven creation

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the enrollments for the student.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id', 'student_id');
    }

    /**
     * Get all courses the student is enrolled in.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id');
    }

    /**
     * Get all teachers that teach the student's courses.
     */
    public function teachers()
    {
        return $this->hasManyThrough(
            Teacher::class, 
            Enrollment::class, 
            'student_id',  // Foreign key in enrollments table linking to students
            'teacher_id',  // Foreign key in enrollments table linking to teachers
            'student_id',  // Primary key in students table
            'teacher_id'   // Primary key in teachers table
        );
    }

    /**
     * Get all feedback provided by the student.
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'student_id', 'student_id');
    }
}
