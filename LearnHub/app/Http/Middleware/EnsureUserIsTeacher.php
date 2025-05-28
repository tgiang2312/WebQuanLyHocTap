<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EnsureUserIsTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!Auth::check() || ($user && $user->role !== 'teacher' && $user->role !== 'admin')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Bạn không có quyền truy cập trang này.'], 403);
            }
            
            return redirect()->route('dashboard')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        return $next($request);
    }
} 