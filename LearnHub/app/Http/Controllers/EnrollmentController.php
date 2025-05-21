<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the enrollments for the logged-in user.
     */
    public function index()
    {
        $enrollments = Auth::user()->enrollments()->with('course.teacher')->get();
        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Enroll the authenticated user in a course.
     */
    public function enroll(Course $course)
    {
        // Check if the course is published
        if ($course->status !== 'published') {
            return redirect()->route('courses.show', $course)
                ->with('error', 'Khóa học này chưa được công bố');
        }
        
        // Check if the user is already enrolled
        $existingEnrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();
            
        if ($existingEnrollment) {
            return redirect()->route('courses.show', $course)
                ->with('info', 'Bạn đã đăng ký khóa học này rồi');
        }
        
        // Create the enrollment
        Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => 'active',
            'progress' => 0,
        ]);
        
        return redirect()->route('courses.show', $course)
            ->with('success', 'Bạn đã đăng ký khóa học thành công');
    }

    /**
     * Update the enrollment progress.
     */
    public function updateProgress(Course $course, Request $request)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->firstOrFail();
            
        $request->validate([
            'progress' => 'required|integer|min:0|max:100',
        ]);
        
        $enrollment->update([
            'progress' => $request->progress,
            'status' => $request->progress == 100 ? 'completed' : 'active',
        ]);
        
        return response()->json(['success' => true]);
    }

    /**
     * Remove an enrollment (drop a course).
     */
    public function destroy(Course $course)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->firstOrFail();
            
        $enrollment->delete();
        
        return redirect()->route('enrollments.index')
            ->with('success', 'Bạn đã hủy đăng ký khóa học thành công');
    }
    
    /**
     * Display students enrolled in a course (for teachers).
     */
    public function students(Course $course)
    {
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'Bạn không có quyền xem danh sách học viên');
        }
        
        $enrollments = $course->enrollments()->with('student')->get();
        
        return view('enrollments.students', compact('course', 'enrollments'));
    }
} 