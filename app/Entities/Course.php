<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $table = 'courses';

    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'short_description',
        'grade_id',
        'subject_id',
        'tuition_fee',
        'lp_complete_bonus',
        'type',
        'max_student',
        'min_student',
        'joined_students',
        'start_at',
        'end_at',
        'status'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
}
