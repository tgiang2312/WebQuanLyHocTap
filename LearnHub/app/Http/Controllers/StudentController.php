<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Assignment;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Hiển thị dashboard học viên
     */
    public function dashboard()
    {
        // Lấy các khóa học mà học viên đã đăng ký
        $enrolledCourses = Enrollment::where('user_id', Auth::id())
            ->with('course')
            ->get()
            ->map(function ($enrollment) {
                return [
                    'id' => $enrollment->course->id,
                    'title' => $enrollment->course->title,
                    'description' => $enrollment->course->description,
                    'category' => $enrollment->course->category,
                    'instructor' => $enrollment->course->teacher->name,
                    'image' => $enrollment->course->image ? asset('storage/' . $enrollment->course->image) : null,
                    'progress' => $enrollment->progress,
                    'completed' => $enrollment->completed,
                    'lastLesson' => $enrollment->last_lesson_title ?? 'Chưa học bài nào',
                ];
            });
        
        // Lấy các bài tập sắp đến hạn
        $upcomingAssignments = Assignment::whereHas('lesson.course.enrollments', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->where('due_date', '>=', now())
            ->orderBy('due_date')
            ->take(3)
            ->get()
            ->map(function ($assignment) {
                return [
                    'id' => $assignment->id,
                    'title' => $assignment->title,
                    'course' => $assignment->lesson->course->title,
                    'dueDate' => $assignment->due_date,
                ];
            });
        
        // Lấy các thành tích của học viên
        $achievements = Achievement::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function ($achievement) {
                return [
                    'id' => $achievement->id,
                    'title' => $achievement->title,
                    'icon' => $achievement->icon ?? '🏆',
                    'date' => $achievement->created_at,
                ];
            });
        
        return view('students.dashboard', compact('enrolledCourses', 'upcomingAssignments', 'achievements'));
    }
    
    /**
     * Hiển thị danh sách khóa học của học viên
     */
    public function courses(Request $request)
    {
        $status = $request->input('status');
        $category = $request->input('category');
        $sort = $request->input('sort', 'newest');
        
        // Lấy danh sách khóa học đã đăng ký với bộ lọc
        $enrollmentsQuery = Enrollment::where('user_id', Auth::id())
            ->with('course');
        
        if ($status) {
            if ($status == 'completed') {
                $enrollmentsQuery->where('completed', true);
            } elseif ($status == 'in_progress') {
                $enrollmentsQuery->where('completed', false);
            }
        }
        
        if ($category) {
            $enrollmentsQuery->whereHas('course', function ($query) use ($category) {
                $query->where('category', $category);
            });
        }
        
        // Sắp xếp
        if ($sort == 'newest') {
            $enrollmentsQuery->orderBy('created_at', 'desc');
        } elseif ($sort == 'oldest') {
            $enrollmentsQuery->orderBy('created_at', 'asc');
        } elseif ($sort == 'progress') {
            $enrollmentsQuery->orderBy('progress', 'desc');
        }
        
        $enrolledCourses = $enrollmentsQuery->get()
            ->map(function ($enrollment) {
                return [
                    'id' => $enrollment->course->id,
                    'title' => $enrollment->course->title,
                    'description' => $enrollment->course->description,
                    'category' => $enrollment->course->category,
                    'instructor' => $enrollment->course->teacher->name,
                    'image' => $enrollment->course->image ? asset('storage/' . $enrollment->course->image) : null,
                    'progress' => $enrollment->progress,
                    'completed' => $enrollment->completed,
                    'duration' => $enrollment->course->duration ?? 'N/A',
                    'enrolled_date' => $enrollment->created_at->format('d/m/Y'),
                ];
            });
        
        return view('students.courses', compact('enrolledCourses', 'status', 'category', 'sort'));
    }
    
    /**
     * Hiển thị trang thành tích của học viên
     */
    public function achievements()
    {
        $achievements = Achievement::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('students.achievements', compact('achievements'));
    }
    
    /**
     * Hiển thị danh sách bài tập của học viên
     */
    public function assignments(Request $request)
    {
        $query = Assignment::whereHas('lesson.course.enrollments', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['lesson.course', 'submissions' => function($query) {
                $query->where('user_id', Auth::id());
            }]);
        
        // Tìm kiếm theo từ khóa
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Lọc theo trạng thái
        if ($request->has('status') && $request->input('status')) {
            $status = $request->input('status');
            
            if ($status === 'pending') {
                $query->whereDoesntHave('submissions', function($q) {
                    $q->where('user_id', Auth::id());
                });
            } elseif ($status === 'submitted') {
                $query->whereHas('submissions', function($q) {
                    $q->where('user_id', Auth::id())
                      ->whereNull('grade');
                });
            } elseif ($status === 'graded') {
                $query->whereHas('submissions', function($q) {
                    $q->where('user_id', Auth::id())
                      ->whereNotNull('grade');
                });
            }
        }
        
        $assignments = $query->orderBy('due_date')->get();
        
        return view('students.assignments', compact('assignments'));
    }
} 