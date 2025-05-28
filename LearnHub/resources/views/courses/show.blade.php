@extends('layouts.app')

@section('title', $course->title . ' - LearnHub')

@section('content')
<div class="container py-5">
    <!-- Course Header -->
    <div class="bg-light rounded-3 p-4 p-md-5 mb-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <span class="badge bg-primary mb-3">{{ $course->category }}</span>
                <h1 class="fw-bold mb-3">{{ $course->title }}</h1>
                <p class="lead mb-4">{{ $course->description }}</p>
                
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-people-fill text-primary me-1"></i>
                        <span>{{ $course->enrollments()->count() }} học viên</span>
                    </div>
                    @if($course->sessions)
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar-week me-1 text-muted"></i>
                        <span>{{ $course->sessions }} buổi học</span>
                    </div>
                    @endif
                    <div class="d-flex align-items-center">
                        <i class="bi bi-book me-1 text-muted"></i>
                        <span>{{ $course->lessons->count() }} bài học</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-bar-chart me-1 text-muted"></i>
                        <span>
                            @if($course->level == 'beginner')
                                Cơ bản
                            @elseif($course->level == 'intermediate')
                                Trung cấp
                            @elseif($course->level == 'advanced')
                                Nâng cao
                            @else
                                {{ $course->level }}
                            @endif
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar me-1 text-muted"></i>
                        <span>Cập nhật: {{ $course->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ $course->teacher->avatar ?? asset('images/avatar-placeholder.jpg') }}" 
                         alt="{{ $course->teacher->name }}" 
                         class="rounded-circle me-3" style="width: 48px; height: 48px; object-fit: cover;">
                    <div>
                        <h5 class="fw-medium mb-0">Giảng viên: {{ $course->teacher->name }}</h5>
                        <p class="text-muted small mb-0">{{ $course->teacher->email }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        @if($isEnrolled)
                            <div class="mb-4">
                                <h5 class="fw-semibold mb-3">Tiến độ khóa học</h5>
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated course-progress-bar" 
                                         role="progressbar" 
                                         aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted small">
                                    {{ $progress }}% hoàn thành
                                </p>
                            </div>
                            <a href="{{ route('courses.learn', $course) }}" class="btn btn-primary w-100 mb-3">
                                <i class="bi bi-play-fill me-2"></i> Tiếp tục học
                            </a>
                        @else
                            <div class="text-center mb-4">
                                <h3 class="fw-bold mb-0">{{ number_format($course->price, 0, ',', '.') }} ₫</h3>
                                @if($course->price == 0)
                                    <span class="badge bg-success">Miễn phí</span>
                                @endif
                            </div>
                            <form action="{{ route('enrollments.enroll', $course) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    Đăng ký khóa học
                                </button>
                            </form>
                        @endif
                        
                        @if(Auth::check() && (Auth::id() == $course->teacher_id || Auth::user()->isAdmin()))
                            <div class="mt-3 pt-3 border-top">
                                <h6 class="fw-semibold mb-3">Quản lý khóa học</h6>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil me-1"></i> Chỉnh sửa
                                    </a>
                                    <a href="{{ route('lessons.create', $course) }}" class="btn btn-outline-success">
                                        <i class="bi bi-plus-circle me-1"></i> Thêm bài học
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Content Tabs -->
    <ul class="nav nav-tabs mb-4" id="courseTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-medium" id="content-tab" data-bs-toggle="tab" 
                    data-bs-target="#content-tab-pane" type="button" role="tab" 
                    aria-controls="content-tab-pane" aria-selected="true">
                Nội dung khóa học
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-medium" id="instructor-tab" data-bs-toggle="tab" 
                    data-bs-target="#instructor-tab-pane" type="button" role="tab" 
                    aria-controls="instructor-tab-pane" aria-selected="false">
                Giảng viên
            </button>
        </li>
    </ul>
    
    <div class="tab-content" id="courseTabContent">
        <!-- Content Tab -->
        <div class="tab-pane fade show active" id="content-tab-pane" role="tabpanel" 
             aria-labelledby="content-tab" tabindex="0">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-bottom">
                    <h4 class="fw-semibold mb-1">Nội dung khóa học</h4>
                    <p class="text-muted mb-0">
                        {{ $course->lessons->count() }} bài học
                        @if($course->sessions)
                            • {{ $course->sessions }} buổi học
                        @endif
                    </p>
                </div>
                @if($course->lessons->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($course->lessons as $index => $lesson)
                        <div class="list-group-item p-4 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-3" style="width: 40px; height: 40px;">
                                        <span class="d-flex align-items-center justify-content-center fw-medium">
                                            {{ $lesson->order }}
                                        </span>
                                    </div>
                                    <div>
                                        <h5 class="fw-medium mb-1">{{ $lesson->title }}</h5>
                                    </div>
                                </div>
                                @if($isEnrolled || Auth::id() == $course->teacher_id || (Auth::check() && Auth::user()->isAdmin()))
                                    <a href="{{ route('lessons.show', $lesson) }}" 
                                       class="btn btn-primary btn-sm">
                                        <i class="bi bi-play-fill me-1"></i> Xem bài học
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                <div class="card-body p-5 text-center">
                    <div class="py-5">
                        <i class="bi bi-journal-text text-muted" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">Khóa học chưa có nội dung</h4>
                        <p class="text-muted">Giảng viên đang chuẩn bị nội dung cho khóa học này.</p>
                        
                        @if(Auth::check() && Auth::id() == $course->teacher_id)
                            <a href="{{ route('lessons.create', $course) }}" class="btn btn-primary mt-3">
                                <i class="bi bi-plus-circle me-2"></i> Thêm bài học đầu tiên
                            </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Instructor Tab -->
        <div class="tab-pane fade" id="instructor-tab-pane" role="tabpanel" 
             aria-labelledby="instructor-tab" tabindex="0">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ $course->teacher->avatar ?? asset('images/avatar-placeholder.jpg') }}" 
                             alt="{{ $course->teacher->name }}" class="rounded-circle me-4" 
                             style="width: 100px; height: 100px; object-fit: cover;">
                        <div>
                            <h3 class="fw-bold mb-1">{{ $course->teacher->name }}</h3>
                            <p class="text-muted mb-3">Giảng viên</p>
                            <p>{{ $course->teacher->email }}</p>
                        </div>
                    </div>
                    
                    <h4 class="fw-semibold mb-3">Các khóa học khác từ giảng viên này</h4>
                    <div class="row g-4">
                        @php
                            $otherCourses = App\Models\Course::where('teacher_id', $course->teacher_id)
                                ->where('id', '!=', $course->id)
                                ->take(3)
                                ->get();
                        @endphp
                        
                        @forelse($otherCourses as $otherCourse)
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm course-card">
                                    <img src="{{ $otherCourse->image ? asset('storage/' . $otherCourse->image) : asset('images/course-placeholder.jpg') }}" 
                                         class="card-img-top" alt="{{ $otherCourse->title }}" 
                                         style="height: 160px; object-fit: cover;">
                                    <div class="card-body">
                                        <span class="badge bg-primary mb-2">{{ $otherCourse->category }}</span>
                                        <h5 class="card-title fw-semibold">{{ $otherCourse->title }}</h5>
                                        <p class="card-text text-muted">
                                            {{ Str::limit($otherCourse->description, 80) }}
                                        </p>
                                    </div>
                                    <div class="card-footer bg-white border-top-0">
                                        <a href="{{ route('courses.show', $otherCourse) }}" class="btn btn-outline-primary w-100">
                                            Xem khóa học
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">Giảng viên này chưa có khóa học khác.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .progress-bar-animated {
        animation: progress-bar-stripes 1s linear infinite;
    }
    
    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 0.75rem 1rem;
    }
    
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
    }
    
    .nav-tabs .nav-link:hover:not(.active) {
        border-bottom: 2px solid #dee2e6;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Đặt chiều rộng cho thanh tiến trình
        const progressBar = document.querySelector('.course-progress-bar');
        if (progressBar) {
            progressBar.style.width = '{{ $progress }}%';
        }
    });
</script>
@endsection
