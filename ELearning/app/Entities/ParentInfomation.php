<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ParentInfomation extends Model
{
    //
    protected $table = 'parent_infomations';

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
