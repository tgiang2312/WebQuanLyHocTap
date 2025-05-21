<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'status' => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('course-thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

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
        
        return view('courses.show', compact('course'));
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
            'status' => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            
            $path = $request->file('thumbnail')->store('course-thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

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

        // Delete thumbnail if exists
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
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
} 