<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class QuizQuestionAnswer extends Model
{
    //
    protected $table = 'quiz_question_answers';

    protected $fillable = [
        'quiz_question_id',
        'answer',
        'is_right',
    ];

    public function quizQuestion()
    {
        return $this->belongsTo(QuizQuestion::class, 'quiz_id');
    }
}
