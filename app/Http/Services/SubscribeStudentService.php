<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Statics\ParentStudentStatusStatic;

class SubscribeStudentService {

    public function subscribeStudent($id)
    {
        $user = Auth::user();
        $studentSubscribed = $user->childsSubscribed()->create(
            [
                'student_id' => $id,
                'status' => ParentStudentStatusStatic::PENDING
            ]
        );
        return response()
            ->json($studentSubscribed);
    }

}

?>