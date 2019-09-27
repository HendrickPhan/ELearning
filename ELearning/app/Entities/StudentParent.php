<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    //
    protected $table = 'student_parent';

    protected $fillable = [
        'id',
        'user_id',
        'student_id',
        'connect_status',
    ];

}
