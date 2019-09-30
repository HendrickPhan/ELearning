<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    //
    protected $table = 'certificates';

    protected $fillable = [
        'id',
        'created_by',
        'name',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    } 
}
