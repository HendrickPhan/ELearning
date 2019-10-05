<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    protected $table = 'quizs';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
