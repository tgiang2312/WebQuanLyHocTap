<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Assignment;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Hiển thị dashboard giảng viên
     */
    public function dashboard()
    {
        // Lấy các khóa học mà giảng viên đã tạo
        $myCreatedCourses = Course::where('teacher_id', Auth::id())
            ->latest()
            ->get();
        
        // Tính tổng số học viên từ tất cả khóa học
        $totalStudents = 0;
        foreach($myCreatedCourses as $course) {
            $totalStudents += $course->enrollments()->count();
        }
        
        // Lấy các hoạt động gần đây liên quan đến khóa học của giảng viên
        $recentActivities = \App\Models\Activity::whereHas('course', function ($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->with(['user', 'course'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Lấy các bài tập gần đây của giảng viên
        $recentAssignments = Assignment::whereHas('course', function ($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->with(['course', 'submissions'])
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();
        
        return view('teachers.dashboard', compact('myCreatedCourses', 'totalStudents', 'recentActivities', 'recentAssignments'));
    }
    
    /**
     * Hiển thị danh sách khóa học của giảng viên
     */
    public function courses(Request $request)
    {
        $status = $request->input('status');
        $category = $request->input('category');
        $sort = $request->input('sort', 'newest');
        
        // Lấy danh sách khóa học đã tạo với bộ lọc
        $myCoursesQuery = Course::where('teacher_id', Auth::id());
        
        if ($status) {
            $myCoursesQuery->where('status', $status);
        }
        
        if ($category) {
            $myCoursesQuery->where('category', $category);
        }
        
        // Sắp xếp
        if ($sort == 'newest') {
            $myCoursesQuery->orderBy('created_at', 'desc');
        } elseif ($sort == 'oldest') {
            $myCoursesQuery->orderBy('created_at', 'asc');
        } elseif ($sort == 'students') {
            $myCoursesQuery->withCount('enrollments')->orderBy('enrollments_count', 'desc');
        }
        
        $myCreatedCourses = $myCoursesQuery->get();
        
        return view('teachers.courses', compact('myCreatedCourses', 'status', 'category', 'sort'));
    }
    
    /**
     * Hiển thị danh sách bài tập của giảng viên
     */
    public function assignments()
    {
        $assignments = Assignment::whereHas('course', function ($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->with(['course', 'submissions'])
            ->orderBy('due_date')
            ->get();
            
        return view('teachers.assignments', compact('assignments'));
    }
    
    /**
     * Trang tạo bài tập mới
     */
    public function createAssignment()
    {
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teachers.assignments.create', compact('courses'));
    }
    
    /**
     * Lưu bài tập mới
     */
    public function storeAssignment(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'max_score' => 'required|numeric|min:0',
            'is_form' => 'boolean',
            'questions' => 'nullable|array',
        ]);
        
        // Lấy bài học đầu tiên của khóa học làm lesson_id
        $lessonId = null;
        $course = Course::find($request->course_id);
        if ($course) {
            $firstLesson = $course->lessons()->orderBy('order_number', 'asc')->first();
            if ($firstLesson) {
                $lessonId = $firstLesson->id;
            } else {
                // Nếu khóa học không có bài học nào, tạo một bài học mặc định
                $lesson = new Lesson();
                $lesson->course_id = $course->id;
                $lesson->title = 'Bài tập ' . $request->title;
                $lesson->content = 'Bài học cho bài tập ' . $request->title;
                $lesson->order_number = 1;
                $lesson->save();
                $lessonId = $lesson->id;
            }
        }
        
        if (!$lessonId) {
            return redirect()->back()->with('error', 'Không thể tạo bài tập vì không tìm thấy bài học. Vui lòng tạo bài học trước.');
        }
        
        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->course_id = $request->course_id;
        $assignment->lesson_id = $lessonId;
        $assignment->description = $request->description;
        $assignment->due_date = $request->due_date;
        $assignment->max_score = $request->max_score;
        
        // Xử lý bài tập dạng form
        $assignment->is_form = $request->has('is_form') ? true : false;
        if ($assignment->is_form && $request->has('questions')) {
            $assignment->questions = $request->questions;
        }
        
        $assignment->save();
        
        return redirect()->route('teachers.assignments')->with('success', 'Bài tập đã được tạo thành công.');
    }
    
    /**
     * Hiển thị form tạo bài tập dạng Google Form
     */
    public function createFormAssignment()
    {
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teachers.assignments.create_form', compact('courses'));
    }
    
    /**
     * Lưu bài tập dạng form
     */
    public function storeFormAssignment(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'max_score' => 'required|numeric|min:0',
            'questions' => 'required|array|min:1',
            'questions.*.type' => 'required|in:multiple_choice,checkbox,short_answer,paragraph,file_upload',
            'questions.*.title' => 'required|string',
            'questions.*.options' => 'nullable|array',
            'questions.*.required' => 'boolean',
            'questions.*.points' => 'nullable|numeric|min:0',
        ]);
        
        // Lấy bài học đầu tiên của khóa học làm lesson_id
        $lessonId = null;
        $course = Course::find($request->course_id);
        if ($course) {
            $firstLesson = $course->lessons()->orderBy('order_number', 'asc')->first();
            if ($firstLesson) {
                $lessonId = $firstLesson->id;
            } else {
                // Nếu khóa học không có bài học nào, tạo một bài học mặc định
                $lesson = new Lesson();
                $lesson->course_id = $course->id;
                $lesson->title = 'Bài tập ' . $request->title;
                $lesson->content = 'Bài học cho bài tập ' . $request->title;
                $lesson->order_number = 1;
                $lesson->save();
                $lessonId = $lesson->id;
            }
        }
        
        if (!$lessonId) {
            return redirect()->back()->with('error', 'Không thể tạo bài tập vì không tìm thấy bài học. Vui lòng tạo bài học trước.');
        }
        
        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->course_id = $request->course_id;
        $assignment->lesson_id = $lessonId;
        $assignment->description = $request->description;
        $assignment->due_date = $request->due_date;
        $assignment->max_score = $request->max_score;
        $assignment->is_form = true;
        $assignment->questions = $request->questions;
        $assignment->save();
        
        return redirect()->route('teachers.assignments')->with('success', 'Bài tập dạng form đã được tạo thành công.');
    }
    
    /**
     * Hiển thị báo cáo phân tích
     */
    public function analytics()
    {
        // Thống kê về số lượng học viên đăng ký theo thời gian
        $enrollmentStats = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->where('courses.teacher_id', Auth::id())
            ->select(DB::raw('DATE(enrollments.created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        // Thống kê về tiến độ học tập của học viên
        $progressStats = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->where('courses.teacher_id', Auth::id())
            ->select(
                'courses.title as course',
                DB::raw('AVG(enrollments.progress) as avg_progress'),
                DB::raw('COUNT(CASE WHEN enrollments.completed = 1 THEN 1 END) as completed_count'),
                DB::raw('COUNT(*) as total_count')
            )
            ->groupBy('courses.id', 'courses.title')
            ->get();
        
        return view('teachers.analytics', compact('enrollmentStats', 'progressStats'));
    }
    
    /**
     * Hiển thị hoạt động gần đây
     */
    public function activities()
    {
        // Lấy danh sách hoạt động gần đây liên quan đến khóa học của giảng viên
        $activities = \App\Models\Activity::whereHas('course', function ($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->orWhere('user_id', Auth::id())
            ->with(['user', 'course'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('teachers.activities', compact('activities'));
    }
} 