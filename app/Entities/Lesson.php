<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    protected $table = 'lessons';

    protected $fillable = [
        'title',
        'description',
        'video',
        'quiz_id',
        'essay_id',
        'start_at',
        'end_at'
    ];
}
