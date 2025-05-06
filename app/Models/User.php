<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'user','password','role'
    ];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at'=>'datetime'];

    public function evaluationsGiven()
    {
        return $this->hasMany(Evaluation::class, 'evaluator_id');
    }
    public function evaluationsReceived()
    {
        return $this->hasMany(Evaluation::class, 'teacher_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }
}
