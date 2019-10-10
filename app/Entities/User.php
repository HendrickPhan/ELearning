<?php

namespace App\Entities;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password', 
        'role',
        'avatar',
        'date_of_birth',
        'description',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function teacherInformation()
    {
        return $this->hasOne(TeacherInformation::class, 'user_id');
    }

    public function teacherCertificates()
    {
        return $this->belongsToMany(Certificate::class, 'teacher_certificate', 'user_id', 'certificate_id')
            ->withPivot(['date_of_issue', 'image']);
    }

    public function teacherGradeSubject()
    {
        return $this->hasMany(TeacherGradeSubject::class, 'user_id');
    }

    public function studentInformation()
    {
        return $this->hasOne(StudentInformation::class, 'user_id');
    }

    public function parentInformation()
    {
        return $this->hasOne(ParentInformation::class, 'user_id');
    }

    public function studentsSubscribed()
    {
        return $this->hasMany(TeacherStudent::class, 'teacher_id');
    }

    public function teachersSubscribed()
    {
        return $this->hasMany(TeacherStudent::class, 'student_id');
    }

    public function childsSubscribed()
    {
        return $this->hasMany(ParentStudent::class, 'parent_id');
    }

    public function parentsSubscribed()
    {
        return $this->hasMany(ParentStudent::class, 'student_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'created_by');
    }

    public function quizs()
    {
        return $this->hasMany(Quiz::class, 'created_by');
    }

    public function essays()
    {
        return $this->hasMany(Essay::class, 'created_by');
    }
}