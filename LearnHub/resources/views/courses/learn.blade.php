@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar với danh sách bài học -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Nội dung khóa học</h5>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($course->lessons as $lesson)
                        <a href="{{ route('lessons.show', $lesson) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center 
                                {{ $firstLesson && $firstLesson->id == $lesson->id ? 'active' : '' }}">
                            <div>
                                <span class="fw-bold">{{ $lesson->order }}.</span> {{ $lesson->title }}
                            </div>
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </a>
                    @empty
                        <div class="list-group-item">Chưa có bài học nào</div>
                    @endforelse
                </div>
            </div>

            <!-- Thông tin khóa học -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Thông tin khóa học</h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="card-text text-muted">Giảng viên: {{ $course->teacher->name }}</p>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span>Tiến độ học tập</span>
                            <span>{{ $progress }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $progress }}%" 
                                 aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-info-circle"></i> Chi tiết khóa học
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Nội dung chính -->
            <div class="card">
                <div class="card-body">
                    @if($firstLesson)
                        <div class="text-center">
                            <h3>Bắt đầu khóa học với bài học đầu tiên</h3>
                            <p class="text-muted">Hãy nhấn vào nút bên dưới để bắt đầu học bài đầu tiên</p>
                            <a href="{{ route('lessons.show', $firstLesson) }}" class="btn btn-primary btn-lg mt-3">
                                <i class="bi bi-play-circle"></i> Bắt đầu học
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                            <h3 class="mt-3">Khóa học chưa có nội dung</h3>
                            <p class="text-muted">Giảng viên đang chuẩn bị nội dung cho khóa học này. Vui lòng quay lại sau.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Thông tin bổ sung -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Giới thiệu khóa học</h5>
                </div>
                <div class="card-body">
                    <p>{{ $course->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 