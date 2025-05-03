<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['evaluator_id', 'teacher_id', 'score', 'comments', 'semester', 'school_year'];

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
