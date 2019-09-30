<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Statics\UserRolesStatic;
use App\Helpers\Statics\UserStatusStatic;

class AdminService {

    public function activateUser($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()
            ->json(trans('message.user_not_found'), 400); 
        }

        $user->status = UserStatusStatic::ACTIVE;

        return response()
            ->json($user); 
    }

    public function deactivateUser($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()
            ->json(trans('message.user_not_found'), 400); 
        }

        $user->status = UserStatusStatic::INACTIVE;

        return response()
            ->json($user); 
    }

}



?>