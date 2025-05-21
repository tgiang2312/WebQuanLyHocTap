<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Show the form for creating/editing a submission.
     */
    public function create(Assignment $assignment)
    {
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        // Check if user is enrolled
        $isEnrolled = $course->students()->where('user_id', Auth::id())->exists();
        
        if (!$isEnrolled) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bạn cần đăng ký khóa học để nộp bài');
        }
        
        // Check if past due date
        if ($assignment->due_date && now() > $assignment->due_date) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bài tập đã quá hạn nộp');
        }
        
        // Get existing submission if any
        $submission = Submission::where('assignment_id', $assignment->id)
            ->where('user_id', Auth::id())
            ->first();
            
        return view('submissions.create', compact('assignment', 'submission'));
    }

    /**
     * Store a newly created submission in storage or update existing one.
     */
    public function store(Request $request, Assignment $assignment)
    {
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        // Check if user is enrolled
        $isEnrolled = $course->students()->where('user_id', Auth::id())->exists();
        
        if (!$isEnrolled) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bạn cần đăng ký khóa học để nộp bài');
        }
        
        // Check if past due date
        if ($assignment->due_date && now() > $assignment->due_date) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bài tập đã quá hạn nộp');
        }
        
        $validated = $request->validate([
            'content' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // 10MB max
        ]);
        
        // At least one of content or file must be provided
        if (empty($validated['content']) && !$request->hasFile('file')) {
            return back()->withErrors(['content' => 'Bạn phải cung cấp nội dung hoặc tệp đính kèm']);
        }
        
        // Find existing submission or create new one
        $submission = Submission::firstOrNew([
            'assignment_id' => $assignment->id,
            'user_id' => Auth::id(),
        ]);
        
        if (isset($validated['content'])) {
            $submission->content = $validated['content'];
        }
        
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($submission->file_url) {
                Storage::disk('public')->delete($submission->file_url);
            }
            
            $path = $request->file('file')->store('submissions', 'public');
            $submission->file_url = $path;
        }
        
        $submission->submitted_at = now();
        $submission->save();
        
        return redirect()->route('assignments.show', $assignment)
            ->with('success', 'Bài làm của bạn đã được nộp thành công');
    }

    /**
     * Display a specific submission (for grading by teacher).
     */
    public function show(Submission $submission)
    {
        $assignment = $submission->assignment;
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        // Only teacher of the course or the student who submitted can view
        if (Auth::id() !== $course->teacher_id && 
            Auth::id() !== $submission->user_id && 
            !Auth::user()->isAdmin()) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bạn không có quyền xem bài nộp này');
        }
        
        return view('submissions.show', compact('submission'));
    }

    /**
     * Grade a submission (teacher only).
     */
    public function grade(Request $request, Submission $submission)
    {
        $assignment = $submission->assignment;
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            return redirect()->route('submissions.show', $submission)
                ->with('error', 'Bạn không có quyền chấm điểm');
        }
        
        $validated = $request->validate([
            'grade' => 'required|numeric|min:0|max:10',
            'feedback' => 'nullable|string',
        ]);
        
        $submission->update($validated);
        
        return redirect()->route('submissions.show', $submission)
            ->with('success', 'Bài làm đã được chấm điểm thành công');
    }
    
    /**
     * Download submission file.
     */
    public function download(Submission $submission)
    {
        $assignment = $submission->assignment;
        $lesson = $assignment->lesson;
        $course = $lesson->course;
        
        // Only teacher of the course or the student who submitted can download
        if (Auth::id() !== $course->teacher_id && 
            Auth::id() !== $submission->user_id && 
            !Auth::user()->isAdmin()) {
            return redirect()->route('assignments.show', $assignment)
                ->with('error', 'Bạn không có quyền tải xuống tệp này');
        }
        
        if (!$submission->file_url) {
            return back()->with('error', 'Không có tệp đính kèm');
        }
        
        return Storage::disk('public')->download($submission->file_url);
    }
} 