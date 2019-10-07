<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Traits\UploadImageTrait;

class UserService {
    use UploadImageTrait;

    public function update($request)
    {
        $user = Auth::user();
        
        $data = $request->except('_method');  

        $avatar = $request->file('avatar');
        if (isset($avatar)) {
            $filePath = $this->uploadAvatar($avatar);
            $data['avatar'] = $filePath;
        }

        if(isset($data['password']))
        {
            $data['password'] = Hash::make($data['password']);
        }

        foreach ($data as $key => $value) {
            $user->$key = $value;
        }
        
        $user->save();
       
        return response()
            ->json($user);
    }

}

?>