<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TeacherGradeSubject extends Model
{
     //
     protected $table = 'teacher_grade_subject';

     protected $fillable = [
         'id',
         'user_id',
         'grade_id',
         'subject_id',
     ];
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
    
    public function grade()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 

    public function subject()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
}