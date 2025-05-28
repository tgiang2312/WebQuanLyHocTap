<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Lesson;
use App\Models\Activity;
use App\Models\Submission;
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
        
        if (Auth::id() !== $course->teacher_id && Auth::user()->role !== 'admin') {
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
        
        if (Auth::id() !== $course->teacher_id && Auth::user()->role !== 'admin') {
            return redirect()->route('lessons.show', $lesson)
                ->with('error', 'Bạn không có quyền tạo bài tập');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'max_score' => 'required|integer|min:1|max:100',
            'is_form' => 'required|boolean',
        ]);
        
        // Tạo bài tập cơ bản
        $assignment = new Assignment();
        $assignment->lesson_id = $lesson->id;
        $assignment->course_id = $course->id;
        $assignment->title = $validated['title'];
        $assignment->description = $validated['description'];
        $assignment->due_date = $validated['due_date'];
        $assignment->max_score = $validated['max_score'];
        $assignment->is_form = $validated['is_form'];
        
        // Nếu là bài tập dạng form, lưu các câu hỏi
        if ($validated['is_form']) {
            $questions = $request->input('questions', []);
            
            // Loại bỏ các câu hỏi trống
            $filteredQuestions = [];
            foreach ($questions as $key => $question) {
                if (!empty($question['text'])) {
                    // Chuyển đổi từ text sang title
                    $question['title'] = $question['text'];
                    unset($question['text']);
                    
                    // Đảm bảo các trường cần thiết tồn tại
                    $question['required'] = isset($question['required']) ? true : false;
                    $question['points'] = $validated['max_score'] / count($questions); // Điểm mặc định cho mỗi câu hỏi
                    
                    // Xử lý các tùy chọn cho câu hỏi trắc nghiệm
                    if (in_array($question['type'], ['multiple_choice', 'checkbox']) && isset($question['options'])) {
                        $question['options'] = array_filter($question['options'], function($option) {
                            return !empty($option);
                        });
                    } else {
                        $question['options'] = [];
                    }
                    
                    $filteredQuestions[] = $question;
                }
            }
            
            $assignment->questions = $filteredQuestions;
        }
        
        $assignment->save();
        
        // Lưu thông tin bài nộp
        $submission = new Submission();
        $submission->assignment_id = $assignment->id;
        $submission->user_id = Auth::id();
        $submission->content = $request->content;
        $submission->status = 'submitted';
        $submission->submitted_at = now();
        
        // Kiểm tra nếu nộp muộn
        if ($assignment->due_date && now() > $assignment->due_date) {
            $submission->is_late = true;
        }
        
        $submission->save();
        
        // Ghi lại hoạt động
        Activity::log(
            Auth::id(),
            'submission',
            'Đã nộp bài tập: ' . $assignment->title,
            null,
            $assignment->course_id
        );
        
        return redirect()->route('assignments.show', $assignment)
            ->with('success', 'Bài tập đã được tạo thành công');
    }

    /**
     * Display the specified assignment.
     */
    public function show(Assignment $assignment)
    {
        // Kiểm tra xem người dùng có quyền xem bài tập này không
        $course = $assignment->course;
        $canView = false;
        
        if (Auth::check()) {
            // Giáo viên hoặc admin có thể xem mọi bài tập
            if (Auth::id() === $course->teacher_id || Auth::user()->role === 'admin') {
                $canView = true;
            } 
            // Học viên chỉ có thể xem bài tập nếu đã đăng ký khóa học
            else {
                $canView = $course->enrollments()->where('user_id', Auth::id())->exists();
            }
        }
        
        if (!$canView) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'Bạn không có quyền xem bài tập này.');
        }
        
        // Kiểm tra xem người dùng đã nộp bài chưa
        $submission = null;
        if (Auth::check()) {
            $submission = $assignment->submissions()->where('user_id', Auth::id())->first();
        }
        
        // Nếu là bài tập dạng form, sử dụng view form_show
        if ($assignment->is_form) {
            return view('assignments.form_show', compact('assignment', 'submission'));
        }
        
        return view('assignments.show', compact('assignment', 'submission'));
    }

    /**
     * Show the form for editing the specified assignment.
     */
    public function edit(Assignment $assignment)
    {
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && Auth::user()->role !== 'admin') {
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
        
        if (Auth::id() !== $course->teacher_id && Auth::user()->role !== 'admin') {
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
        
        if (Auth::id() !== $course->teacher_id && Auth::user()->role !== 'admin') {
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
        
        if (Auth::id() !== $course->teacher_id && Auth::user()->role !== 'admin') {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bạn không có quyền xem danh sách bài nộp');
        }
        
        $submissions = $assignment->submissions()->with('student')->get();
        
        return view('assignments.submissions', compact('assignment', 'submissions'));
    }
} 