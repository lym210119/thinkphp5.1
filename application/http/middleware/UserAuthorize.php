<?php

namespace app\http\middleware;

use think\facade\Hook;

class UserAuthorize
{
    public function handle($request, \Closure $next)
    {
        // 注册 UserPolicy 策略，传入请求的 ID 值，再根据上面的代码进行判断
        $result = Hook::exec('app\\behavior\\UserPolicy', $request->id);
        return
            $result
            ? $next($request)
            : redirect('user/session/create')->with('validate', '非法操作');
    }
}