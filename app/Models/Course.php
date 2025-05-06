<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; // Match the table's primary key
    public $incrementing = true; // Auto-incrementing ID
    protected $keyType = 'int';
    protected $guarded = []; // Allows all fields for admin-driven creation

    /**
     * Get the teacher that teaches this course.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }

    /**
     * Get the enrollments for this course.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'id');
    }

    /**
     * Get all students enrolled in this course.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'course_id', 'student_id');
    }

    /**
     * Get all feedback for this course.
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'course_id', 'id');
    }
}