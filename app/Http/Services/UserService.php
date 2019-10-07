<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;

class UserService {

    public function update($request)
    {
        $userAuth = \Auth::user();
        $data = $request->all();    
        $user = User::find($userAuth->id);

        $avatar = $request->file('avatar');

        //basic user info
        if(isset($data['name']))
        {
            $user['name'] = $data['name'];
        }
        if(isset($data['password']))
        {
            $user['password'] = Hash::make($data['password']);
        }
        if(isset($data['date_of_birth']))
        {
            $user['date_of_birth'] = $data['date_of_birth'];
        }
        if(isset($data['description']))
        {
            $user['description'] = $data['description'];
        }
        if(isset($avatar))
        {
            $filePath = $this->uploadAvatar($avatar);
            $user['avatar'] = $filePath;
        }
        $user->save();
       
        return response()
            ->json($user);
    }

}

?>