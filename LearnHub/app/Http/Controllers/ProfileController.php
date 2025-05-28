<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Hiển thị hồ sơ người dùng
     */
    public function show()
    {
        $user = User::find(Auth::id());
        return view('profile.show', compact('user'));
    }
    
    /**
     * Hiển thị form chỉnh sửa hồ sơ
     */
    public function edit()
    {
        $user = User::find(Auth::id());
        return view('profile.edit', compact('user'));
    }
    
    /**
     * Cập nhật thông tin hồ sơ
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        
        // Xác định loại cập nhật dựa trên các trường được gửi lên
        if ($request->has('current_password') && $request->has('password')) {
            // Cập nhật mật khẩu
            $validated = $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);
            
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.']);
            }
            
            $user->password = Hash::make($request->password);
            $user->save();
            
            return back()->with('success', 'Mật khẩu đã được cập nhật thành công.');
        } 
        elseif ($request->hasFile('avatar')) {
            // Cập nhật ảnh đại diện và thông tin cá nhân
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'bio' => 'nullable|string|max:1000',
                'phone' => 'nullable|string|max:20',
                'birthday' => 'nullable|date',
            ]);
            
            if ($request->hasFile('avatar')) {
                // Xóa ảnh cũ nếu có
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
                
                $path = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $path;
            }
            
            $user->name = $request->name;
            $user->bio = $request->bio;
            $user->phone = $request->phone;
            $user->birthday = $request->birthday;
            $user->save();
            
            return back()->with('success', 'Thông tin cá nhân đã được cập nhật thành công.');
        }
        elseif ($request->has('title') || $request->has('expertise') || $request->has('experience')) {
            // Cập nhật thông tin giảng viên
            $validated = $request->validate([
                'title' => 'nullable|string|max:100',
                'expertise' => 'nullable|string|max:255',
                'experience' => 'nullable|string|max:1000',
            ]);
            
            $user->title = $request->title;
            $user->expertise = $request->expertise;
            $user->experience = $request->experience;
            $user->save();
            
            return back()->with('success', 'Thông tin giảng viên đã được cập nhật thành công.');
        }
        elseif ($request->has('email_notifications') || $request->has('language')) {
            // Cập nhật tùy chỉnh
            $user->email_notifications = $request->has('email_notifications');
            $user->language = $request->language;
            $user->save();
            
            return back()->with('success', 'Tùy chỉnh đã được lưu thành công.');
        }
        else {
            // Cập nhật thông tin cơ bản
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'bio' => 'nullable|string|max:1000',
                'phone' => 'nullable|string|max:20',
                'birthday' => 'nullable|date',
            ]);
            
            $user->name = $request->name;
            $user->bio = $request->bio;
            $user->phone = $request->phone;
            $user->birthday = $request->birthday;
            $user->save();
            
            return back()->with('success', 'Thông tin cá nhân đã được cập nhật thành công.');
        }
    }
    
    /**
     * Xóa tài khoản người dùng
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'delete_confirmation' => 'required|in:XÓA TÀI KHOẢN',
        ], [
            'delete_confirmation.in' => 'Vui lòng nhập chính xác "XÓA TÀI KHOẢN" để xác nhận.',
        ]);
        
        $user = User::find(Auth::id());
        
        // Xóa avatar nếu có
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        
        // Đăng xuất người dùng
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Xóa tài khoản
        $user->delete();
        
        return redirect()->route('home')->with('success', 'Tài khoản của bạn đã được xóa thành công.');
    }
} 