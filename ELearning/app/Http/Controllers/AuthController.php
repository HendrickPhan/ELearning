<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    //
    protected $service;

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        return $this->service->login($request);
    }

    public function logout()
    {
        return $this->service->logout();
    }

    public function info()
    {
        return $this->service->info();
    }
}
