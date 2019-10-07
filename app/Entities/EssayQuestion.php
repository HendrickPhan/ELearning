<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class EssayQuestion extends Model
{
    //
    protected $table = 'essay_questions';

    protected $fillable = [
        'essay_id',
        'question',
        'point'
    ];

    public function essay()
    {
        return $this->belongsTo(Essay::class, 'user_id');
    }
}
