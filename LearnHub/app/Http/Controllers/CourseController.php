<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        $courses = Course::where('status', 'published')->with('teacher')->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        if (!Auth::user()->isTeacher() && !Auth::user()->isAdmin()) {
            return redirect()->route('courses.index')->with('error', 'Bạn không có quyền tạo khóa học');
        }
        
        return view('courses.create');
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isTeacher() && !Auth::user()->isAdmin()) {
            return redirect()->route('courses.index')->with('error', 'Bạn không có quyền tạo khóa học');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'level' => 'required|in:beginner,intermediate,advanced',
            'status' => 'required|in:draft,published',
            'sessions' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/courses', 'public');
            $validated['image'] = $path;
        }

        // Tạo slug từ title
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        
        // Kiểm tra và đảm bảo slug là duy nhất
        $count = 1;
        while (Course::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }
        
        $validated['slug'] = $slug;
        $validated['teacher_id'] = Auth::id();

        $course = Course::create($validated);
        
        return redirect()->route('courses.show', $course)->with('success', 'Khóa học đã được tạo thành công');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        $course->load(['teacher', 'lessons' => function($query) {
            $query->orderBy('order_number', 'asc');
        }]);
        
        // Khởi tạo biến mặc định
        $isEnrolled = false;
        $progress = 0;
        
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            // Kiểm tra xem người dùng đã đăng ký khóa học này chưa
            $enrollment = Auth::user()->enrolledCourses()->where('course_id', $course->id)->first();
            if ($enrollment) {
                $isEnrolled = true;
                $progress = $enrollment->pivot->progress ?? 0;
            }
        }
        
        return view('courses.show', compact('course', 'isEnrolled', 'progress'));
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('courses.show', $course)->with('error', 'Bạn không có quyền chỉnh sửa khóa học này');
        }
        
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('courses.show', $course)->with('error', 'Bạn không có quyền chỉnh sửa khóa học này');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'level' => 'required|in:beginner,intermediate,advanced',
            'status' => 'required|in:draft,published',
            'sessions' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            
            $path = $request->file('image')->store('images/courses', 'public');
            $validated['image'] = $path;
        }

        // Cập nhật slug từ title
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        
        // Kiểm tra và đảm bảo slug là duy nhất (bỏ qua chính khóa học hiện tại)
        $count = 1;
        while (Course::where('slug', $slug)->where('id', '!=', $course->id)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }
        
        $validated['slug'] = $slug;
        $course->update($validated);
        
        return redirect()->route('courses.show', $course)->with('success', 'Khóa học đã được cập nhật thành công');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('courses.show', $course)->with('error', 'Bạn không có quyền xóa khóa học này');
        }

        // Delete image if exists
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        
        $course->delete();
        
        return redirect()->route('courses.index')->with('success', 'Khóa học đã được xóa thành công');
    }
    
    /**
     * Display all courses created by the authenticated teacher.
     */
    public function myCourses()
    {
        if (!Auth::user()->isTeacher()) {
            return redirect()->route('courses.index');
        }
        
        $courses = Course::where('teacher_id', Auth::id())->get();
        
        return view('courses.my-courses', compact('courses'));
    }
    
    /**
     * Display courses by category.
     */
    public function category($category)
    {
        $categoryName = str_replace('-', ' ', $category);
        $courses = Course::where('status', 'published')
                        ->where('category', 'like', "%{$categoryName}%")
                        ->with('teacher')
                        ->get();
        
        return view('courses.category', [
            'courses' => $courses,
            'category' => ucwords($categoryName)
        ]);
    }
} 