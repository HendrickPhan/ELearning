<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TeacherStudent extends Model
{
    //
    protected $table = 'teacher_student';

    protected $fillable = [
        'id',
        'teacher_id',
        'student_id',
        'is_favorite_teacher',
        'is_favorite_studnet',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
