<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class EssayQuestion extends Model
{
    //
    protected $table = 'essay_questions';

    protected $fillable = [
        'document',
        'question',
        'point'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
