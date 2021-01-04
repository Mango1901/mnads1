<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class checkAdminLogin
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
        // nếu user đã đăng nhập
        if (Auth::check())
        {
            $user = Auth::user();
            // nếu level =1 (admin), status = 1 (actived) thì cho qua.
            if ($user->active == 1 && $user->status == 0 && $user->active_expired >= date("Y-m-d"))
            {
                return $next($request);
            }
            else
            {
                $user_refresh_token = User::where('id', Auth::user()->id)->first();
                $user_refresh_token->token = Str::random(60);
                $user_refresh_token->save();
                Auth::logout();
                return redirect('login')->with('error','Your account did not have permission to login');
            }
        } else
            return redirect('login');

    }
}


