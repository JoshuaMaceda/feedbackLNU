<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id'; // Tell Laravel that 'teacher_id' is the actual primary key
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'teacher_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
