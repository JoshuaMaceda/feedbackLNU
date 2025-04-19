<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'teacher_id','evaluator_id','source_type','scores','comments'
    ];
    protected $casts = ['scores'=>'array'];

    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }
    public function evaluator()
    {
        return $this->belongsTo(User::class,'evaluator_id');
    }
}
