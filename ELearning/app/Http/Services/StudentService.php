<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Statics\UserRolesStatic;
use App\Helpers\Statics\UserStatusStatic;
use App\Helpers\Traits\UploadImageTrait;

class StudentService {
    use UploadImageTrait;

    public function register($request)
    {
        $data = $request->all();
        $avatar = $request->file('avatar');
        $filePath = $this->uploadAvatar($avatar);

        $userData = [
            'name' => $data['name'], 
            'email' => $data['email'], 
            'password' => Hash::make($data['password']), 
            'date_of_birth' => $data['date_of_birth'],
            'role' => UserRolesStatic::STUDENT,
            'description' => $data['description'],
            'avatar' => $filePath,
            'status' => UserStatusStatic::INACTIVE
        ];
        
        $user = User::create($userData);

        $studentData = [
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
        ];
        $user->studentInfomation()->create($studentData);


        $user->load('studentInformation');

        return response()
            ->json($user); 
    }

    public function info()
    {
        $user = \Auth::user();
        $user->load('studentInformation');

        return response()
            ->json($user);
    }
}



?>