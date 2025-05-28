<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }

        $user = Auth::user();
        
        foreach ($roles as $role) {
            // Sử dụng các phương thức isAdmin(), isTeacher(), isStudent() từ model User
            $checkMethod = 'is' . ucfirst($role);
            
            if (method_exists($user, $checkMethod) && $user->$checkMethod()) {
                return $next($request);
            }
        }
        
        return abort(403, 'Bạn không có quyền truy cập trang này.');
    }
} 