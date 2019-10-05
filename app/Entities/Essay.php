<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Essay extends Model
{
    //
    protected $table = 'essays';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
