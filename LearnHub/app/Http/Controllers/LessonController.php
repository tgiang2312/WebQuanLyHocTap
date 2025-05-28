<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Show the form for creating a new lesson.
     */
    public function create(Course $course)
    {
        if (! Gate::allows('create-lesson', $course)) {
            abort(403, 'Bạn không có quyền tạo bài học cho khóa học này.');
        }
        
        return view('lessons.create', compact('course'));
    }

    /**
     * Store a newly created lesson in storage.
     */
    public function store(Request $request, Course $course)
    {
        if (! Gate::allows('create-lesson', $course)) {
            abort(403, 'Bạn không có quyền tạo bài học cho khóa học này.');
        }
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'video_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'files.*' => 'nullable|file|max:10240', // 10MB max file size
        ]);
        
        $lesson = new Lesson();
        $lesson->title = $validated['title'];
        $lesson->content = $validated['content'];
        $lesson->video_url = $validated['video_url'] ?? null;
        $lesson->order_number = $validated['order'] ?? $course->lessons()->count() + 1;
        $lesson->course_id = $course->id;
        
        // Xử lý file đính kèm
        if ($request->hasFile('files')) {
            $fileUrls = [];
            foreach ($request->file('files') as $file) {
                $path = $file->store('lesson-files/' . $course->id, 'public');
                $fileUrls[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                ];
            }
            $lesson->files = json_encode($fileUrls);
        }
        
        $lesson->save();
        
        return redirect()->route('courses.show', $course)->with('success', 'Bài học đã được tạo thành công!');
    }

    /**
     * Display the specified lesson.
     */
    public function show(Lesson $lesson)
    {
        $course = $lesson->course;
        $isEnrolled = false;
        $progress = 0;
        
        if (Auth::check()) {
            $enrollment = Auth::user()->enrolledCourses()->where('course_id', $course->id)->first();
            $isEnrolled = (bool) $enrollment;
            $progress = $enrollment ? $enrollment->pivot->progress : 0;
            
            // Nếu người dùng không phải giáo viên của khóa học và chưa đăng ký
            if (!$isEnrolled && Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
                return redirect()->route('courses.show', $course)
                    ->with('error', 'Bạn cần đăng ký khóa học để xem bài học này.');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Bạn cần đăng nhập để xem bài học này.');
        }
        
        $nextLesson = $course->lessons()
            ->where('order_number', '>', $lesson->order_number)
            ->orderBy('order_number')
            ->first();
            
        $prevLesson = $course->lessons()
            ->where('order_number', '<', $lesson->order_number)
            ->orderByDesc('order_number')
            ->first();
            
        return view('lessons.show', compact('lesson', 'course', 'nextLesson', 'prevLesson', 'isEnrolled', 'progress'));
    }

    /**
     * Show the form for editing the specified lesson.
     */
    public function edit(Lesson $lesson)
    {
        if (! Gate::allows('update-lesson', $lesson)) {
            abort(403, 'Bạn không có quyền chỉnh sửa bài học này.');
        }
        
        $course = $lesson->course;
        return view('lessons.edit', compact('lesson', 'course'));
    }

    /**
     * Update the specified lesson in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        if (! Gate::allows('update-lesson', $lesson)) {
            abort(403, 'Bạn không có quyền chỉnh sửa bài học này.');
        }
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'video_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'files.*' => 'nullable|file|max:10240', // 10MB max file size
        ]);
        
        $lesson->title = $validated['title'];
        $lesson->content = $validated['content'];
        $lesson->video_url = $validated['video_url'] ?? null;
        $lesson->order_number = $validated['order'] ?? $lesson->order_number;
        
        // Xử lý file đính kèm
        if ($request->hasFile('files')) {
            $currentFiles = json_decode($lesson->files ?? '[]', true);
            $fileUrls = $currentFiles;
            
            foreach ($request->file('files') as $file) {
                $path = $file->store('lesson-files/' . $lesson->course_id, 'public');
                $fileUrls[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                ];
            }
            $lesson->files = json_encode($fileUrls);
        }
        
        // Xóa file nếu có yêu cầu
        if ($request->has('delete_files')) {
            $currentFiles = json_decode($lesson->files ?? '[]', true);
            $filesToKeep = [];
            
            foreach ($currentFiles as $file) {
                if (!in_array($file['path'], $request->delete_files)) {
                    $filesToKeep[] = $file;
                } else {
                    Storage::disk('public')->delete($file['path']);
                }
            }
            
            $lesson->files = json_encode($filesToKeep);
        }
        
        $lesson->save();
        
        return redirect()->route('lessons.show', $lesson)->with('success', 'Bài học đã được cập nhật thành công!');
    }

    /**
     * Remove the specified lesson from storage.
     */
    public function destroy(Lesson $lesson)
    {
        if (! Gate::allows('delete-lesson', $lesson)) {
            abort(403, 'Bạn không có quyền xóa bài học này.');
        }
        
        $course = $lesson->course;
        
        // Xóa các file đính kèm
        $files = json_decode($lesson->files ?? '[]', true);
        foreach ($files as $file) {
            Storage::disk('public')->delete($file['path']);
        }
        
        $lesson->delete();
        
        // Cập nhật thứ tự các bài học còn lại
        $course->lessons()->where('order_number', '>', $lesson->order_number)->decrement('order_number');
        
        return redirect()->route('courses.show', $course)->with('success', 'Bài học đã được xóa thành công!');
    }
    
    /**
     * Reorder lessons for a course.
     */
    public function reorder(Request $request, Course $course)
    {
        if (! Gate::allows('update-course', $course)) {
            abort(403, 'Bạn không có quyền sắp xếp lại bài học của khóa học này.');
        }
        
        $validated = $request->validate([
            'lessons' => 'required|array',
            'lessons.*.id' => 'required|integer|exists:lessons,id',
            'lessons.*.order' => 'required|integer|min:1',
        ]);
        
        foreach ($validated['lessons'] as $lessonData) {
            $lesson = Lesson::find($lessonData['id']);
            if ($lesson && $lesson->course_id == $course->id) {
                $lesson->order_number = $lessonData['order'];
                $lesson->save();
            }
        }
        
        return response()->json(['success' => true]);
    }
} 