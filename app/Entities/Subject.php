<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $table = 'subjects';

    protected $fillable = [
        'id',
        'name',
        'status',
    ];
}
