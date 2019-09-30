<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;
use App\Helpers\Statics\UserStatusStatic;

class ActiveStatusAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if (!$user || $user->status != UserStatusStatic::ACTIVE) {
            return response()->json(
                trans('message.forbidden') ,
                403
            );
        }

        return $next($request);
    }
}
