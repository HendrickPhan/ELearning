<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $table = 'courses';

    protected $fillable = [
        'teacher_id',
        'name',
        'avatar',
        'description',
        'short_description',
        'tuition_fee',
        'grade_id',
        'subject_id',
        'min_student',
        'start_at',
        'end_at',
        // 'status'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'course_lesson', 'course_id', 'lesson_id')
            ->withPivot([
                'start_at', 
                'end_at'
            ]);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
        
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function enrolledStudent()
    {
        return $this->belongsToMany(User::class, 'course_enrolls', 'course_id', 'student_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'course_id');
    }
}
