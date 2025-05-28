@extends('layouts.app')

@section('title', $course->title . ' - Học tập - LearnHub')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar danh sách bài học -->
        <div class="col-lg-3 col-md-4 bg-light sidebar-lessons" style="height: calc(100vh - 60px); overflow-y: auto;">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">{{ $course->title }}</h5>
                    <button class="btn btn-sm btn-outline-secondary d-md-none" id="closeSidebar">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="text-muted small mb-4">{{ $progress }}% hoàn thành</p>
                
                <div class="list-group list-group-flush">
                    @foreach($lessons as $lesson)
                        <a href="{{ route('lessons.show', $lesson) }}" 
                           class="list-group-item list-group-item-action border-0 rounded py-3 px-3 mb-1 
                                  {{ $currentLesson && $currentLesson->id == $lesson->id ? 'active bg-primary' : '' }}">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    @if($lesson->completed)
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @else
                                        <span class="badge rounded-pill bg-light text-dark">{{ $loop->iteration }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-medium">{{ $lesson->title }}</h6>
                                    <p class="text-muted small mb-0">
                                        @if($lesson->duration)
                                            <i class="bi bi-clock me-1"></i> {{ $lesson->duration }} phút
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Nội dung bài học -->
        <div class="col-lg-9 col-md-8 main-content" style="height: calc(100vh - 60px); overflow-y: auto;">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <button class="btn btn-sm btn-outline-primary d-md-none" id="openSidebar">
                        <i class="bi bi-list"></i> Danh sách bài học
                    </button>
                    <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại trang khóa học
                    </a>
                </div>
                
                @if($currentLesson)
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h4 class="fw-bold mb-0">{{ $currentLesson->title }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="lesson-content mb-4">
                                {!! $currentLesson->content !!}
                            </div>
                            
                            @if($currentLesson->video_url)
                                <div class="ratio ratio-16x9 mb-4">
                                    <iframe src="{{ $currentLesson->video_url }}" 
                                            title="{{ $currentLesson->title }}" 
                                            allowfullscreen></iframe>
                                </div>
                            @endif
                            
                            @if($currentLesson->attachments)
                                <div class="mt-4">
                                    <h5 class="fw-semibold">Tài liệu đính kèm</h5>
                                    <div class="list-group">
                                        @foreach($currentLesson->attachments as $attachment)
                                            <a href="{{ Storage::url($attachment->file_path) }}" 
                                               class="list-group-item list-group-item-action d-flex align-items-center" 
                                               target="_blank">
                                                <i class="bi bi-file-earmark-text me-3 text-primary"></i>
                                                <div>
                                                    <h6 class="mb-0">{{ $attachment->title }}</h6>
                                                    <small class="text-muted">{{ $attachment->file_size }}</small>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer bg-white py-3">
                            <div class="d-flex justify-content-between">
                                @php
                                    $prevLesson = $lessons->where('order_number', '<', $currentLesson->order_number)
                                                         ->sortByDesc('order_number')
                                                         ->first();
                                    $nextLesson = $lessons->where('order_number', '>', $currentLesson->order_number)
                                                         ->sortBy('order_number')
                                                         ->first();
                                @endphp
                                
                                @if($prevLesson)
                                    <a href="{{ route('lessons.show', $prevLesson) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-arrow-left me-2"></i> Bài trước
                                    </a>
                                @else
                                    <div></div>
                                @endif
                                
                                <form action="{{ route('enrollments.progress', $course) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="lesson_id" value="{{ $currentLesson->id }}">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle me-2"></i> Đánh dấu hoàn thành
                                    </button>
                                </form>
                                
                                @if($nextLesson)
                                    <a href="{{ route('lessons.show', $nextLesson) }}" class="btn btn-primary">
                                        Bài tiếp theo <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                @else
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-primary">
                                        Hoàn thành khóa học <i class="bi bi-trophy ms-2"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bài tập của bài học -->
                    @if($currentLesson->assignments && $currentLesson->assignments->count() > 0)
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-header bg-white py-3">
                                <h5 class="fw-bold mb-0">Bài tập</h5>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach($currentLesson->assignments as $assignment)
                                    <div class="list-group-item p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="fw-medium mb-1">{{ $assignment->title }}</h6>
                                                <p class="text-muted small mb-0">
                                                    @if($assignment->due_date)
                                                        <i class="bi bi-calendar-event me-1"></i>
                                                        Hạn nộp: {{ $assignment->due_date->format('d/m/Y H:i') }}
                                                    @endif
                                                </p>
                                            </div>
                                            <a href="{{ route('assignments.show', $assignment) }}" class="btn btn-sm btn-outline-primary">
                                                Xem bài tập
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <div class="alert alert-info">
                        <p class="mb-0">Khóa học này chưa có bài học nào.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý hiển thị/ẩn sidebar trên mobile
        const openSidebarBtn = document.getElementById('openSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');
        const sidebar = document.querySelector('.sidebar-lessons');
        
        if (openSidebarBtn && closeSidebarBtn) {
            openSidebarBtn.addEventListener('click', function() {
                sidebar.classList.add('show');
                sidebar.style.transform = 'translateX(0)';
            });
            
            closeSidebarBtn.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebar.style.transform = 'translateX(-100%)';
            });
        }
    });
</script>
@endsection

@section('styles')
<style>
    @media (max-width: 767.98px) {
        .sidebar-lessons {
            position: fixed;
            top: 60px;
            left: 0;
            width: 80%;
            z-index: 1030;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .sidebar-lessons.show {
            transform: translateX(0);
        }
    }
    
    .lesson-content img {
        max-width: 100%;
        height: auto;
    }
</style>
@endsection 