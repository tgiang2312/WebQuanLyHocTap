<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the enrollments for the logged-in user.
     */
    public function index()
    {
        $enrollments = Enrollment::where('user_id', Auth::id())->with('course.teacher')->get();
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
        
        // Ghi lại hoạt động
        Activity::log(
            Auth::id(),
            'enrollment',
            'Đã đăng ký khóa học: ' . $course->title,
            null,
            $course->id
        );
        
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
        
        // Nếu có lesson_id được gửi lên, cập nhật bài học hiện tại
        if ($request->has('lesson_id')) {
            $lessonId = $request->lesson_id;
            
            // Cập nhật bài học hiện tại
            $enrollment->update([
                'last_lesson_id' => $lessonId,
                'last_lesson_title' => $course->lessons()->find($lessonId)->title ?? null,
            ]);
            
            // Tính toán tiến độ dựa trên số bài học đã hoàn thành
            $totalLessons = $course->lessons()->count();
            if ($totalLessons > 0) {
                // Giả sử mỗi bài học có giá trị như nhau
                $completedLessons = $enrollment->completedLessons()->count() + 1;
                $progress = min(round(($completedLessons / $totalLessons) * 100), 100);
                
                // Cập nhật tiến độ và trạng thái
                $enrollment->update([
                    'progress' => $progress,
                    'status' => $progress == 100 ? 'completed' : 'active',
                    'completed' => $progress == 100,
                ]);
                
                // Đánh dấu bài học này là đã hoàn thành
                $enrollment->completedLessons()->syncWithoutDetaching([$lessonId]);
            }
            
            return redirect()->back()->with('success', 'Đã đánh dấu bài học hoàn thành');
        }
        
        // Cập nhật tiến độ trực tiếp nếu có
        if ($request->has('progress')) {
            $request->validate([
                'progress' => 'required|integer|min:0|max:100',
            ]);
            
            $enrollment->update([
                'progress' => $request->progress,
                'status' => $request->progress == 100 ? 'completed' : 'active',
                'completed' => $request->progress == 100,
            ]);
            
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('error', 'Không có dữ liệu cập nhật');
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
        if (Auth::id() !== $course->teacher_id && Auth::user()->role !== 'admin') {
            return redirect()->route('courses.show', $course)
                ->with('error', 'Bạn không có quyền xem danh sách học viên');
        }
        
        $enrollments = $course->enrollments()->with('student')->get();
        
        return view('enrollments.students', compact('course', 'enrollments'));
    }

    /**
     * Đăng ký khóa học mới
     */
    public function store(Request $request, Course $course)
    {
        // ... existing code ...
        
        // Tạo bản ghi đăng ký
        $enrollment = new Enrollment();
        $enrollment->user_id = Auth::id();
        $enrollment->course_id = $course->id;
        $enrollment->status = 'active';
        $enrollment->progress = 0;
        $enrollment->save();
        
        // Ghi lại hoạt động
        Activity::log(
            Auth::id(),
            'enrollment',
            'Đã đăng ký khóa học: ' . $course->title,
            null,
            $course->id
        );
        
        // ... existing code ...
    }
} 