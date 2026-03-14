<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthLogin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::user()) {
            if(isset($_COOKIE['buker_cookie'])){
                $cookies = htmlspecialchars($_COOKIE['buker_cookie']);
                if($cookies){
                    return redirect(url('login-attempt?cookies='.$cookies));
                }
            }
            return redirect(url('login'));
        }
        return $next($request);
    }
}
