<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    //
    protected $table = 'quiz_attempts';

    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id',
        'quiz_id',
        'point',
        'total_point'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'course_id' => 'integer',
        'lesson_id' => 'integer',
        'quiz_id' => 'integer',
        'point' => 'integer',
        'total_point' => 'integer',
    ];
    
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }

    public function details()
    {
        return $this->hasMany(QuizAttemptDetail::class, 'quiz_attempt_id');
    }

}
