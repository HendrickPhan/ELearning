<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Helpers\Statics\UserRolesStatic;
use App\Helpers\Statics\UserStatusStatic;
use App\Helpers\Traits\UploadImageTrait;

class ParentService {
    use UploadImageTrait;

    public function index($request)
    {
        $limit = $request->get('limit', 10);
        $keyword = $request->get('keyword', null);
        $status = $request->get('status', null);
        $parentsQuery = User::select(['id', 'name', 'email', 'description'])
            ->where('role', UserRolesStatic::PARENT);
        
        if ($keyword) {
            $parentsQuery->where(function($query) use ($keyword){
                $query->where('email', 'like', '%'.$keyword.'%');
                $query->orWhere('name', 'like' , '%'.$keyword.'%');
            });
        }
        
        if (!is_null($status)) {
            $parentsQuery->where('status', $status);
        }

        $parents = $parentsQuery->paginate($limit)
            ->appends(
                request()->query()
            );

        return response()
            ->json($parents);         
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
        $user = auth()->user();
        $user->load([
            'parentInformation',
        ]);

        return response()
            ->json($user);
    }

    public function detail($id)
    {
        $parent = User::with([
            'parentInformation'
            ])
            ->select(
                'id', 
                'name',
                'email', 
                'avatar',
                'date_of_birth',
                'description'
            )
            ->where('id', $id)
            ->where('role', UserRolesStatic::PARENT)
            ->where('status', UserStatusStatic::ACTIVE)
            ->first();

        return response()
            ->json($parent);
    }

    public function updateInformation($request)
    {
        $user = Auth::user();
        $data = $request->except('_method');  
        $user->load('teacherInformation');

        foreach ($data as $key => $value) {
            $user->teacherInformation->$key = $value; 
        } 

        return response()
            ->json($user);
    }

}


?>