<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;

class SubscribeTeacherService {

    public function subscribeTeacher($id)
    {
        $user = Auth::user();
        $teachersSubscribed = $user->teachersSubscribed()->create(
            [
                'teacher_id' => $id
            ]
        );
        return response()
            ->json($teachersSubscribed);
    }

}

?>