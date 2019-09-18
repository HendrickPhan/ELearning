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

    public function teacherInfomation()
    {
        return $this->hasOne(TeacherInfomation::class, 'user_id');
    }

    public function teacherCertificates(){
        return $this->belongsToMany(Certificate::class, 'teacher_certificate', 'user_id', 'certificate_id')
            ->withPivot(['date of issue', 'image']);
    }

    public function studentInformation()
    {
        return $this->hasOne(StudentInformation::class, 'user_id');
    }

    
}