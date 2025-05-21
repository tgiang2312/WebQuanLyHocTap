<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Show the form for creating a new assignment.
     */
    public function create(Lesson $lesson)
    {
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('lessons.show', $lesson)
                ->with('error', 'Bạn không có quyền tạo bài tập');
        }
        
        return view('assignments.create', compact('lesson'));
    }

    /**
     * Store a newly created assignment in storage.
     */
    public function store(Request $request, Lesson $lesson)
    {
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('lessons.show', $lesson)
                ->with('error', 'Bạn không có quyền tạo bài tập');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
        
        $assignment = $lesson->assignments()->create($validated);
        
        return redirect()->route('lessons.show', $lesson)
            ->with('success', 'Bài tập đã được tạo thành công');
    }

    /**
     * Display the specified assignment.
     */
    public function show(Assignment $assignment)
    {
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        // Check if user is enrolled or is the teacher
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            $isEnrolled = $course->students()->where('user_id', Auth::id())->exists();
            
            if (!$isEnrolled) {
                return redirect()->route('courses.show', $course)
                    ->with('error', 'Bạn cần đăng ký khóa học để xem bài tập này');
            }
        }
        
        // Get user's submission if exists
        $userSubmission = null;
        if (Auth::check()) {
            $userSubmission = $assignment->submissions()
                ->where('user_id', Auth::id())
                ->first();
        }
        
        $assignment->load('lesson.course');
        
        return view('assignments.show', compact('assignment', 'userSubmission'));
    }

    /**
     * Show the form for editing the specified assignment.
     */
    public function edit(Assignment $assignment)
    {
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bạn không có quyền chỉnh sửa bài tập này');
        }
        
        return view('assignments.edit', compact('assignment'));
    }

    /**
     * Update the specified assignment in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bạn không có quyền chỉnh sửa bài tập này');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
        
        $assignment->update($validated);
        
        return redirect()->route('assignments.show', $assignment)
            ->with('success', 'Bài tập đã được cập nhật thành công');
    }

    /**
     * Remove the specified assignment from storage.
     */
    public function destroy(Assignment $assignment)
    {
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bạn không có quyền xóa bài tập này');
        }
        
        $assignment->delete();
        
        return redirect()->route('lessons.show', $lesson)
            ->with('success', 'Bài tập đã được xóa thành công');
    }
    
    /**
     * View all submissions for an assignment (teacher only).
     */
    public function submissions(Assignment $assignment)
    {
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bạn không có quyền xem danh sách bài nộp');
        }
        
        $submissions = $assignment->submissions()->with('student')->get();
        
        return view('assignments.submissions', compact('assignment', 'submissions'));
    }
} 