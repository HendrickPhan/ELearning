<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class StudentInformation extends Model
{
    //
    protected $table = 'student_information';

    protected $fillable = [
        'id',
        'user_id',
        'phone_number',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 

}
