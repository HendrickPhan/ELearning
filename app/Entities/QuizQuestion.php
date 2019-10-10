<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    //
    protected $table = 'quiz_questions';

    protected $fillable = [
        'quiz_id',
        'question',
        'point',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function quizQuestionAnswers()
    {
        return $this->hasMany(QuizQuestionAnswer::class, 'quiz_question_id');
    }
}
