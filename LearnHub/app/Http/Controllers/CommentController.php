<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string|in:App\\Models\\Lesson,App\\Models\\Course,App\\Models\\Assignment',
        ]);
        
        // Check if user has access to the resource
        $commentableType = $validated['commentable_type'];
        $commentableId = $validated['commentable_id'];
        $commentable = $commentableType::findOrFail($commentableId);
        
        // Determine the course based on the commentable type
        $course = null;
        if ($commentable instanceof Course) {
            $course = $commentable;
        } elseif ($commentable instanceof Lesson) {
            $course = $commentable->course;
        } elseif ($commentable instanceof Assignment) {
            $course = $commentable->lesson->course;
        }
        
        // Check if user is either the teacher or enrolled in the course
        if (Auth::id() !== $course->teacher_id && !Auth::user()->isAdmin()) {
            $isEnrolled = $course->students()->where('user_id', Auth::id())->exists();
            
            if (!$isEnrolled) {
                return back()->with('error', 'Bạn không có quyền bình luận vào tài nguyên này');
            }
        }
        
        // Create the comment
        Comment::create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
            'commentable_id' => $commentableId,
            'commentable_type' => $commentableType,
        ]);
        
        return back()->with('success', 'Bình luận của bạn đã được đăng thành công');
    }

    /**
     * Update the specified comment.
     */
    public function update(Request $request, Comment $comment)
    {
        // Check if user is the author of the comment
        if (Auth::id() !== $comment->user_id && !Auth::user()->isAdmin()) {
            return back()->with('error', 'Bạn không có quyền chỉnh sửa bình luận này');
        }
        
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        
        $comment->update($validated);
        
        return back()->with('success', 'Bình luận đã được cập nhật thành công');
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(Comment $comment)
    {
        // Check if user is the author of the comment or admin
        if (Auth::id() !== $comment->user_id && !Auth::user()->isAdmin()) {
            return back()->with('error', 'Bạn không có quyền xóa bình luận này');
        }
        
        $comment->delete();
        
        return back()->with('success', 'Bình luận đã được xóa thành công');
    }
} 