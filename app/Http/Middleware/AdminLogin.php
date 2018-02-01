<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminLogin
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
        // Nếu xác thực thành công thì thực hiện tiếp, không thì quay lại trang đăng nhập
        if (Auth::check()) {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
