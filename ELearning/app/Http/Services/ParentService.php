<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Statics\UserRolesStatic;
use App\Helpers\Statics\UserStatusStatic;
use App\Helpers\Statics\ConnectParentStatusStatic;
use App\Helpers\Traits\UploadImageTrait;

class ParentService {
    use UploadImageTrait;

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
            'role' => UserRolesStatic::PARENT,
            'description' => $data['description'],
            'avatar' => $filePath,
            'status' => UserStatusStatic::ACTIVE
        ];
        $user = User::create($userData);

        //parent info
        $parentData = [
            'phone_number' => $data['phone_number'],
        ];
        $user->parentInformation()->create($parentData);

        $user->load(['parentInformation']);

        $token = auth()->attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        return response()->json([
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function info()
    {
        $user = \Auth::user();
        $user->load('parentInformation');

        return response()
            ->json($user);
    }
    
    public function subscribe($id)
    {
        $user = \Auth::user();
        $user->studentParents()->attach($id, [
            'connect_status' =>  ConnectParentStatusStatic::PENDING,
        ]);
        $user->load(['parentInformation','studentParents']);
        return response()
            ->json($user);
    }

}


?>