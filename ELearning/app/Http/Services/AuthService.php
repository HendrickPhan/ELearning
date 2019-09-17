<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

class AuthService {

    public function login($request)
    {
        $credentials = $request->all();

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function info()
    {
        return response()->json(auth()->user());
    }
    



}



?>