<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    protected $table = 'grades';

    protected $fillable = [
        'id',
        'name',
        'recommend_from_age',
        'recommend_to_age',
        'status',
    ];
}
