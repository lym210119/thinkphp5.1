<?php

namespace app\http\middleware;

class Auth
{
    public function handle($request, \Closure $next)
    {
        if (session('?user')) {
            return $next($request);
        } else {
            redirect('user/session/create')->with('validate', '请先登录');
        }
    }
}