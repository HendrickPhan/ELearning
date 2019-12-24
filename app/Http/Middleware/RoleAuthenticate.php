<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;
use App\Helpers\Statics\UserRolesStatic;

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
        $user = \Auth::user();
        if ((!$user || !in_array($user->role, $roles)) && $user->role!=0) {
            return response()->json(
                trans('message.forbidden') ,
                403
            );
        }
        return $next($request);
    }
}
