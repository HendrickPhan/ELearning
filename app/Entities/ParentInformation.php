<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ParentInformation extends Model
{
    //
    protected $table = 'parent_informations';

    protected $fillable = [
        'id',
        'user_id',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 

}
