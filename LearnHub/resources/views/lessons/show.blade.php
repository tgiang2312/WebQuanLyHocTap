@extends('layouts.app')

@section('title', $lesson->title . ' - ' . $course->title)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-3 border-0">
                    <h5 class="fw-bold mb-0">{{ $course->title }}</h5>
                    <p class="text-muted small mb-0 mt-1">{{ $course->lessons->count() }} bài học</p>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($course->lessons->sortBy('order_number') as $courseLesson)
                            <a href="{{ route('lessons.show', $courseLesson) }}" 
                               class="list-group-item list-group-item-action d-flex align-items-center py-3 px-4 
                                      {{ $courseLesson->id === $lesson->id ? 'active' : '' }}">
                                <div class="me-3">
                                    @if($courseLesson->id === $lesson->id)
                                        <i class="bi bi-play-circle-fill fs-5"></i>
                                    @else
                                        <i class="bi bi-play-circle fs-5"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-semibold">{{ $courseLesson->title }}</h6>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">{{ $lesson->title }}</h2>
                        
                        @if(Auth::id() === $course->teacher_id || Auth::user()->isAdmin())
                            <div>
                                <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-outline-primary me-2">
                                    <i class="bi bi-pencil me-2"></i> Chỉnh sửa
                                </a>
                                <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài học này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-trash me-2"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <!-- Video Section -->
                    @if($lesson->video_url)
                        <div class="ratio ratio-16x9 mb-4">
                            @php
                                $videoId = null;
                                // YouTube
                                if (strpos($lesson->video_url, 'youtube.com') !== false || strpos($lesson->video_url, 'youtu.be') !== false) {
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $lesson->video_url, $matches);
                                    if (isset($matches[1])) {
                                        $videoId = $matches[1];
                                        echo '<iframe src="https://www.youtube.com/embed/' . $videoId . '" title="YouTube video" allowfullscreen></iframe>';
                                    }
                                }
                                // Vimeo
                                elseif (strpos($lesson->video_url, 'vimeo.com') !== false) {
                                    preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|)(\d+)(?:$|\/|\?)/', $lesson->video_url, $matches);
                                    if (isset($matches[1])) {
                                        $videoId = $matches[1];
                                        echo '<iframe src="https://player.vimeo.com/video/' . $videoId . '" title="Vimeo video" allowfullscreen></iframe>';
                                    }
                                }
                                // Other video URL
                                else {
                                    echo '<div class="alert alert-info">Video không được nhúng. <a href="' . $lesson->video_url . '" target="_blank">Xem video</a></div>';
                                }
                            @endphp
                        </div>
                    @endif
                    
                    <!-- Content Section -->
                    <div class="lesson-content mb-4">
                        {!! nl2br(e($lesson->content)) !!}
                    </div>
                    
                    <!-- Attachments Section -->
                    @if($lesson->files)
                        <div class="mt-5">
                            <h5 class="fw-semibold mb-3">Tài liệu đính kèm</h5>
                            <div class="list-group">
                                @foreach(json_decode($lesson->files, true) as $file)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-file-earmark me-2"></i>
                                            <span>{{ $file['name'] }}</span>
                                            <span class="text-muted ms-2">({{ round($file['size'] / 1024, 2) }} KB)</span>
                                        </div>
                                        <a href="{{ Storage::url($file['path']) }}" class="btn btn-sm btn-outline-primary" download>
                                            <i class="bi bi-download"></i> Tải xuống
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Navigation Buttons -->
            <div class="d-flex justify-content-between mb-4">
                @if($prevLesson)
                    <a href="{{ route('lessons.show', $prevLesson) }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i> Bài trước
                    </a>
                @else
                    <div></div>
                @endif
                
                @if($nextLesson)
                    <a href="{{ route('lessons.show', $nextLesson) }}" class="btn btn-primary">
                        Bài tiếp theo <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                @else
                    <a href="{{ route('courses.show', $course) }}" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i> Hoàn thành khóa học
                    </a>
                @endif
            </div>
            
            <!-- Assignment Section -->
            @if($lesson->assignments->count() > 0)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white p-4 border-0">
                        <h4 class="fw-bold mb-0">Bài tập</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="list-group">
                            @foreach($lesson->assignments as $assignment)
                                <a href="{{ route('assignments.show', $assignment) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 fw-semibold">{{ $assignment->title }}</h6>
                                        <p class="text-muted mb-0 small">
                                            <i class="bi bi-calendar me-1"></i> Hạn nộp: {{ $assignment->due_date->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">
                                        <i class="bi bi-arrow-right"></i>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Comments Section -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <h4 class="fw-bold mb-0">Thảo luận</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="commentable_type" value="App\Models\Lesson">
                        <input type="hidden" name="commentable_id" value="{{ $lesson->id }}">
                        <div class="mb-3">
                            <textarea class="form-control" name="content" rows="3" placeholder="Viết bình luận của bạn..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-2"></i> Gửi bình luận
                            </button>
                        </div>
                    </form>
                    
                    <div class="comments-list">
                        @forelse($lesson->comments->sortByDesc('created_at') as $comment)
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-md">
                                        @if($comment->user->avatar)
                                            <img src="{{ Storage::url($comment->user->avatar) }}" alt="{{ $comment->user->name }}" class="rounded-circle">
                                        @else
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                {{ substr($comment->user->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 fw-semibold">{{ $comment->user->name }}</h6>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-0">{{ $comment->content }}</p>
                                    
                                    @if(Auth::id() === $comment->user_id || Auth::id() === $course->teacher_id || Auth::user()->isAdmin())
                                        <div class="mt-2">
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?');">
                                                    <i class="bi bi-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted mb-0">Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 