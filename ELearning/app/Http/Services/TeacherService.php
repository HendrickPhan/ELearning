<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Statics\UserRolesStatic;
use App\Helpers\Statics\UserStatusStatic;
use App\Helpers\Traits\UploadImageTrait;

class TeacherService {
    use UploadImageTrait;

    public function index($request)
    {
        $limit = $request->get('limit', 10);
        $keyword = $request->get('keyword', null);
        $status = $request->get('status', null);
        $teachersQuery = User::select(['id', 'name', 'email', 'description'])
            ->where('role', UserRolesStatic::TEACHER);
        
        if ($keyword) {
            $teachersQuery->where(function($query) use ($keyword){
                $query->where('email', 'like', '%'.$keyword.'%');
                $query->orWhere('name', 'like' , '%'.$keyword.'%');
            });
        }
        
        if (!is_null($status)) {
            $teachersQuery->where('status', $status);
        }

        $teachers = $teachersQuery->paginate($limit)
            ->appends(
                request()->query()
            );

        return response()
            ->json($teachers);         
    }

    public function register($request)
    {
        $data = $request->all();
        $avatar = $request->file('avatar');
        $filePath = $this->uploadAvatar($avatar);

        //basic user info
        $userData = [
            'name' => $data['name'], 
            'email' => $data['email'], 
            'password' => Hash::make($data['password']), 
            'date_of_birth' => $data['date_of_birth'],
            'role' => UserRolesStatic::TEACHER,
            'description' => $data['description'],
            'avatar' => $filePath,
            'status' => UserStatusStatic::INACTIVE
        ];
        $user = User::create($userData);

        //teacher info
        $teacherData = [
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'experience' => isset($data['experience']) ? $data['experience'] : null,
        ];
        $user->teacherInformation()->create($teacherData);

        //certificate info
        $certificates = isset($data['certificates']) ? $data['certificates'] : [];
        foreach($certificates as $certificate){
            $image = $request->file('certificate-' . $certificate['id']);
            $filePath = $image ? $this->uploadCertificate($image) : null;

            $user->teacherCertificates()->attach($certificate['id'], [
                'image' =>  $filePath,
                'date_of_issue' => $certificate['date_of_issue']
            ]);
        }

        //grade-subject info

        $user->load(['teacherInformation','teacherCertificates']);

        return response()
            ->json($user); 
    }

    public function info()
    {
        $user = \Auth::user();
        $user->load('teacherInformation');

        return response()
            ->json($user);
    }
}



?>