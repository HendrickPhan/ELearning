<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\UserService;

class UserController extends Controller
{
    //
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function update(UpdateUserRequest $request)
    {
        return $this->service->update($request);
    }
}
