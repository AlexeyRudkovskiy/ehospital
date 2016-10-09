<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class AuthUsingTokenMiddleware
{

    private $tokenKey = 'x-token';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader($this->tokenKey)) {
            $token = $request->header($this->tokenKey);
            $user = User::where('api_token', $token)->get();
            if ($user->count() == 1) {
                $user = $user->first();
                auth()->loginUsingId($user->id);

                return $next($request);
            }
            abort(403);
        }
        abort(403);
    }
}
