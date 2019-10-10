<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    protected $table = 'quizs';

    protected $fillable = [
        'name'
    ];
    
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }
}
