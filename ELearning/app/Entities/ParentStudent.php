<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ParentStudent extends Model
{
    //
    protected $table = 'parent_student';

    protected $fillable = [
        'id',
        'parent_id',
        'student_id',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
