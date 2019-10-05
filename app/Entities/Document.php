<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $table = 'documents';

    protected $fillable = [
        'document'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
