<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Essay extends Model
{
    //
    protected $table = 'essays';

    protected $fillable = [
        'name'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function essayQuestions()
    {
        return $this->hasMany(EssayQuestion::class, 'essay_id');
    }
}
