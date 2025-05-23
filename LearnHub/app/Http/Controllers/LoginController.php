<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.'
        ])->withInput()->with('error', 'Đăng nhập không thành công!');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'role' => ['nullable', 'in:teacher,student'],
        ]);
        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $request->role === 'teacher' ? 'teacher' : 'student',
            ]);
            Auth::login($user);
            return redirect('/dashboard')->with('success', 'Đăng ký thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Đăng ký không thành công!');
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Đăng xuất thành công!');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Đăng nhập bằng ' . Str::ucfirst($provider) . ' thất bại!');
        }

        $user = User::where('email', $socialUser->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'No Name',
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(16)),
                'role' => 'student',
            ]);
        }
        Auth::login($user, true);
        return redirect('/dashboard')->with('success', 'Đăng nhập thành công!');
    }
}
