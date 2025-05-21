<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * Show the form for creating a new lesson.
     */
    public function create(Course $course)
    {
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('courses.show', $course)->with('error', 'Bạn không có quyền thêm bài học');
        }
        
        return view('lessons.create', compact('course'));
    }

    /**
     * Store a newly created lesson in storage.
     */
    public function store(Request $request, Course $course)
    {
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('courses.show', $course)->with('error', 'Bạn không có quyền thêm bài học');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'order_number' => 'nullable|integer',
        ]);

        // If order number is not provided, put it at the end
        if (!isset($validated['order_number'])) {
            $validated['order_number'] = $course->lessons()->max('order_number') + 1;
        }

        $lesson = $course->lessons()->create($validated);
        
        return redirect()->route('courses.show', $course)->with('success', 'Bài học đã được tạo thành công');
    }

    /**
     * Display the specified lesson.
     */
    public function show(Lesson $lesson)
    {
        $course = $lesson->course;
        
        // Check if user is enrolled or is the teacher
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            $isEnrolled = $course->students()->where('user_id', Auth::id())->exists();
            
            if (!$isEnrolled) {
                return redirect()->route('courses.show', $course)
                    ->with('error', 'Bạn cần đăng ký khóa học để xem bài học này');
            }
        }
        
        $lesson->load(['course', 'assignments']);
        
        return view('lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified lesson.
     */
    public function edit(Lesson $lesson)
    {
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('lessons.show', $lesson)
                ->with('error', 'Bạn không có quyền chỉnh sửa bài học này');
        }
        
        return view('lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified lesson in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('lessons.show', $lesson)
                ->with('error', 'Bạn không có quyền chỉnh sửa bài học này');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'order_number' => 'nullable|integer',
        ]);

        $lesson->update($validated);
        
        return redirect()->route('lessons.show', $lesson)->with('success', 'Bài học đã được cập nhật thành công');
    }

    /**
     * Remove the specified lesson from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('lessons.show', $lesson)
                ->with('error', 'Bạn không có quyền xóa bài học này');
        }
        
        $lesson->delete();
        
        return redirect()->route('courses.show', $course)->with('success', 'Bài học đã được xóa thành công');
    }
    
    /**
     * Reorder lessons for a course.
     */
    public function reorder(Request $request, Course $course)
    {
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return response()->json(['error' => 'Bạn không có quyền sắp xếp lại bài học'], 403);
        }
        
        $request->validate([
            'lessons' => 'required|array',
            'lessons.*.id' => 'required|exists:lessons,id',
            'lessons.*.order' => 'required|integer|min:0',
        ]);
        
        foreach ($request->lessons as $item) {
            Lesson::where('id', $item['id'])
                  ->where('course_id', $course->id)
                  ->update(['order_number' => $item['order']]);
        }
        
        return response()->json(['success' => true]);
    }
} 