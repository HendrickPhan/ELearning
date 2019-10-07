<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;
use App\Helpers\Statics\UserRolesStatic;
use Illuminate\Support\Facades\Auth;

class RoleAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        $user = auth()->user();
        if (!$user || !in_array($user->role, $roles)) {
            return response()->json(
                trans('message.forbidden') ,
                403
            );
        }
        return $next($request);
    }
}
