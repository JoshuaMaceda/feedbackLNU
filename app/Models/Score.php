<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'professionalism' => 'array',
        'commitment' => 'array',
        'knowledge' => 'array',
        'independent_learning' => 'array',
        'management' => 'array',
        'critical_factors' => 'array',
    ];
    
    /**
     * Get the teacher this score is for.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }
    
    /**
     * Get the evaluator (student) who submitted this score.
     */
    public function evaluator()
    {
        return $this->belongsTo(Student::class, 'evaluator_id', 'user_id');
    }
    
    /**
     * Get the evaluation related to this score.
     */
    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }
}