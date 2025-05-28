<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('create-comment')) {
            abort(403, 'Bạn không có quyền bình luận.');
        }
        
        $validated = $request->validate([
            'content' => 'required|string',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string|in:App\Models\Course,App\Models\Lesson',
            'parent_id' => 'nullable|integer|exists:comments,id'
        ]);
        
        // Kiểm tra đối tượng được bình luận có tồn tại không
        $commentableType = $validated['commentable_type'];
        $commentableId = $validated['commentable_id'];
        $commentable = $commentableType::find($commentableId);
        
        if (!$commentable) {
            return back()->with('error', 'Đối tượng bình luận không tồn tại.');
        }
        
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = $validated['content'];
        $comment->commentable_type = $validated['commentable_type'];
        $comment->commentable_id = $validated['commentable_id'];
        $comment->parent_id = $validated['parent_id'] ?? null;
        $comment->save();
        
        return back()->with('success', 'Bình luận đã được đăng thành công!');
    }

    /**
     * Update the specified comment.
     */
    public function update(Request $request, Comment $comment)
    {
        if (! Gate::allows('update-comment', $comment)) {
            abort(403, 'Bạn không có quyền cập nhật bình luận này.');
        }
        
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        
        $comment->content = $validated['content'];
        $comment->save();
        
        return back()->with('success', 'Bình luận đã được cập nhật thành công!');
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(Comment $comment)
    {
        if (! Gate::allows('delete-comment', $comment)) {
            abort(403, 'Bạn không có quyền xóa bình luận này.');
        }
        
        $comment->delete();
        
        return back()->with('success', 'Bình luận đã được xóa thành công!');
    }
} 