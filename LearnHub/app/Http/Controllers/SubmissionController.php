<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Activity;

class SubmissionController extends Controller
{
    /**
     * Hiển thị form nộp bài tập
     */
    public function create(Assignment $assignment)
    {
        // Kiểm tra xem người dùng đã đăng ký khóa học chưa
        $isEnrolled = $assignment->course->enrollments()->where('user_id', Auth::id())->exists();
        
        if (!$isEnrolled) {
            return redirect()->route('courses.show', $assignment->course)
                ->with('error', 'Bạn cần đăng ký khóa học trước khi nộp bài tập.');
        }
        
        // Kiểm tra xem người dùng đã nộp bài chưa
        $submission = $assignment->submissions()->where('user_id', Auth::id())->first();
        
        return view('assignments.show', compact('assignment', 'submission'));
    }
    
    /**
     * Lưu bài tập đã nộp
     */
    public function store(Request $request, Assignment $assignment)
    {
        // Kiểm tra xem người dùng đã đăng ký khóa học chưa
        $isEnrolled = $assignment->course->enrollments()->where('user_id', Auth::id())->exists();
        
        if (!$isEnrolled) {
            return redirect()->route('courses.show', $assignment->course)
                ->with('error', 'Bạn cần đăng ký khóa học trước khi nộp bài tập.');
        }
        
        // Xử lý nộp bài tập dạng form
        if ($assignment->is_form) {
            $answers = $request->input('answers', []);
            $fileAnswers = [];
            
            // Xử lý các câu trả lời dạng file
            if ($request->hasFile('file_answers')) {
                foreach ($request->file('file_answers') as $index => $file) {
                    $path = $file->store('submissions/' . Auth::id(), 'public');
                    $fileAnswers[$index] = [
                        'filename' => $file->getClientOriginalName(),
                        'path' => $path
                    ];
                }
            }
            
            // Tìm submission hiện có hoặc tạo mới
            $submission = $assignment->submissions()->updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'content' => json_encode(['answers' => $answers, 'file_answers' => $fileAnswers]),
                    'submitted_at' => now(),
                    'status' => 'submitted',
                    'is_late' => $assignment->due_date->isPast()
                ]
            );
        } else {
            // Xử lý nộp bài tập thông thường
            $request->validate([
                'content' => 'nullable|string',
                'file' => 'nullable|file|max:10240', // Max 10MB
            ]);
            
            // Tìm submission hiện có hoặc tạo mới
            $submission = $assignment->submissions()->updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'content' => $request->content,
                    'submitted_at' => now(),
                    'status' => 'submitted',
                    'is_late' => $assignment->due_date->isPast()
                ]
            );
            
            // Xử lý file đính kèm
            if ($request->hasFile('file')) {
                // Xóa file cũ nếu có
                if ($submission->file_path) {
                    Storage::disk('public')->delete($submission->file_path);
                }
                
                $path = $request->file('file')->store('submissions/' . Auth::id(), 'public');
                $submission->file_path = $path;
                $submission->file_name = $request->file('file')->getClientOriginalName();
                $submission->save();
            }
        }
        
        return redirect()->route('students.assignments')
            ->with('success', 'Bài tập đã được nộp thành công.');
    }
    
    /**
     * Hiển thị chi tiết bài nộp
     */
    public function show(Submission $submission)
    {
        // Kiểm tra quyền xem
        if (Auth::id() !== $submission->user_id && 
            Auth::id() !== $submission->assignment->course->teacher_id && 
            Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền xem bài nộp này.');
        }
        
        return view('submissions.show', compact('submission'));
    }
    
    /**
     * Cập nhật điểm và phản hồi cho bài nộp
     */
    public function update(Request $request, Submission $submission)
    {
        // Kiểm tra quyền chấm điểm
        if (Auth::id() !== $submission->assignment->course->teacher_id && 
            Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền chấm điểm bài nộp này.');
        }
        
        $request->validate([
            'score' => 'required|numeric|min:0|max:' . $submission->assignment->max_score,
            'feedback' => 'nullable|string'
        ]);
        
        $submission->score = $request->score;
        $submission->feedback = $request->feedback;
        $submission->status = 'graded';
        $submission->graded_at = now();
        $submission->save();
        
        // Ghi lại hoạt động
        Activity::log(
            Auth::id(),
            'grading',
            'Đã chấm điểm bài tập của: ' . $submission->student->name,
            'Điểm: ' . $submission->score . '/' . $submission->assignment->max_score,
            $submission->assignment->course_id
        );
        
        return redirect()->back()->with('success', 'Bài nộp đã được chấm điểm thành công.');
    }
    
    /**
     * Tải xuống file đính kèm
     */
    public function download(Submission $submission)
    {
        // Kiểm tra quyền tải xuống
        if (Auth::id() !== $submission->user_id && 
            Auth::id() !== $submission->assignment->course->teacher_id && 
            Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền tải xuống file này.');
        }
        
        if (!$submission->file_path) {
            return redirect()->back()->with('error', 'Không tìm thấy file đính kèm.');
        }
        
        $path = storage_path('app/public/' . $submission->file_path);
        return response()->download($path, $submission->file_name);
    }
} 