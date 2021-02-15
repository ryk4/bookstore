<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,string $role)
    {
        $roles = [
            'admin'  => 0,
            'normal' => 1
        ];

        if(auth()->user()->user_level > $roles[$role]){
            abort(403);
        }

        return $next($request);
    }
}
