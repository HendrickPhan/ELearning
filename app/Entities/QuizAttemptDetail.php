<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class QuizAttemptDetail extends Model
{
    //
    protected $table = 'quiz_attempt_details';

    protected $fillable = [
        'id',
        'quiz_attempt_id',
        'question_id',
        'answer_id',
        'is_correct',
    ];
    
    public function quizQuestion () {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }

    public function quizAnswer () {
        return $this->belongsTo(QuizQuestionAnswer::class, 'answer_id');
    }
}
