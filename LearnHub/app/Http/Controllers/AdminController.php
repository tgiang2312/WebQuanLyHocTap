<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\Submission;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Hiển thị dashboard quản trị
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    
    /**
     * Hiển thị trang quản lý người dùng
     */
    public function users(Request $request)
    {
        $query = User::query();
        
        // Xử lý tìm kiếm
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Lọc theo vai trò
        if ($request->has('role') && $request->role !== '') {
            $query->where('role', $request->role);
        }
        
        // Lọc theo trạng thái
        if ($request->has('status') && $request->status !== '') {
            if ($request->status === 'active') {
                $query->whereNotNull('email_verified_at');
            } else {
                $query->whereNull('email_verified_at');
            }
        }
        
        $users = $query->latest()->paginate(10);
        
        return view('admin.users', compact('users'));
    }
    
    /**
     * Hiển thị trang quản lý khóa học
     */
    public function courses(Request $request)
    {
        $query = Course::with('teacher');
        
        // Xử lý tìm kiếm
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Lọc theo danh mục
        if ($request->has('category') && $request->category !== '') {
            $query->where('category', $request->category);
        }
        
        // Lọc theo trạng thái
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        // Sắp xếp
        if ($request->has('sort')) {
            if ($request->sort === 'oldest') {
                $query->oldest();
            } elseif ($request->sort === 'popular') {
                $query->withCount('enrollments')->orderBy('enrollments_count', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }
        
        $courses = $query->paginate(10);
        
        // Lấy dữ liệu khóa học theo danh mục
        $categoryCounts = Course::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();
            
        // Lấy danh sách khóa học phổ biến nhất
        $popularCourses = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.courses', compact('courses', 'categoryCounts', 'popularCourses'));
    }
    
    /**
     * Lưu người dùng mới hoặc cập nhật người dùng
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . ($request->id ?? ''),
            'role' => 'required|in:student,teacher,admin',
            'password' => $request->id ? 'nullable|string|min:8' : 'required|string|min:8',
        ]);
        
        if ($request->id) {
            $user = User::findOrFail($request->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
            
            if ($request->filled('password')) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }
            
            return redirect()->route('admin.users')->with('success', 'Người dùng đã được cập nhật');
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => bcrypt($request->password),
            ]);
            
            return redirect()->route('admin.users')->with('success', 'Đã thêm người dùng mới');
        }
    }
    
    /**
     * Xóa người dùng
     */
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('admin.users')->with('success', 'Đã xóa người dùng');
    }
}
