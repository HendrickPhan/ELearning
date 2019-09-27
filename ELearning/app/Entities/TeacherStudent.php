<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TeacherStudent extends Model
{
    //
    protected $table = 'teacher_students';

    protected $fillable = [
        'id',
        'teacher_id',
        'student_id',
        'is_favorite_teacher',
        'is_favorite_studnet',
    ];
}
