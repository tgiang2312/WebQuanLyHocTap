@extends('layouts.app')

@section('title', $course['title'] . ' - LearnHub')

@section('content')
<div class="container py-5">
    <!-- Course Header -->
    <div class="bg-light rounded-3 p-4 p-md-5 mb-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <span class="badge bg-primary mb-3">{{ $course['category'] }}</span>
                <h1 class="fw-bold mb-3">{{ $course['title'] }}</h1>
                <p class="lead mb-4">{{ $course['description'] }}</p>
                
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-star-fill text-warning me-1"></i>
                        <span class="fw-medium me-1">{{ $course['rating'] }}</span>
                        <span class="text-muted">({{ $course['students'] }} học viên)</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-clock me-1 text-muted"></i>
                        <span>{{ $course['duration'] }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-book me-1 text-muted"></i>
                        <span>{{ count($course['lessons']) }} bài học</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-globe me-1 text-muted"></i>
                        <span>{{ $course['language'] }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar me-1 text-muted"></i>
                        <span>Cập nhật: {{ \Carbon\Carbon::parse($course['lastUpdated'])->format('d/m/Y') }}</span>
                    </div>
                </div>
                
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ $course['instructor']['avatar'] ?? asset('images/avatar-placeholder.jpg') }}" 
                         alt="{{ $course['instructor']['name'] }}" 
                         class="rounded-circle me-3" style="width: 48px; height: 48px; object-fit: cover;">
                    <div>
                        <h5 class="fw-medium mb-0">Giảng viên: {{ $course['instructor']['name'] }}</h5>
                        <p class="text-muted small mb-0">{{ $course['instructor']['title'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        @if($course['enrolled'] ?? false)
                            <div class="mb-4">
                                <h5 class="fw-semibold mb-3">Tiến độ khóa học</h5>
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" 
                                         role="progressbar" style="width: {{ $progressPercentage }}%" 
                                         aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="text-muted small">
                                    {{ $completedLessons }}/{{ $totalLessons }} bài học ({{ $progressPercentage }}%)
                                </p>
                            </div>
                            <a href="{{ route('courses.learn', $course['id']) }}" class="btn btn-primary w-100 mb-3">
                                <i class="bi bi-play-fill me-2"></i> Tiếp tục học
                            </a>
                            <a href="{{ route('courses.certificate', $course['id']) }}" class="btn btn-outline-primary w-100">
                                Xem chứng chỉ
                            </a>
                        @else
                            <div class="text-center mb-4">
                                <h3 class="fw-bold mb-0">{{ number_format($course['price'], 0, ',', '.') }} ₫</h3>
                            </div>
                            <a href="{{ route('courses.enroll', $course['id']) }}" class="btn btn-primary w-100 mb-3">
                                Đăng ký khóa học
                            </a>
                            <a href="{{ route('cart.add', $course['id']) }}" class="btn btn-outline-primary w-100 mb-4">
                                Thêm vào giỏ hàng
                            </a>
                            <p class="text-muted small text-center mb-0">
                                <i class="bi bi-shield-check me-1"></i> Đảm bảo hoàn tiền trong 30 ngày
                            </p>
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
            <button class="nav-link fw-medium" id="assignments-tab" data-bs-toggle="tab" 
                    data-bs-target="#assignments-tab-pane" type="button" role="tab" 
                    aria-controls="assignments-tab-pane" aria-selected="false">
                Bài tập
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-medium" id="reviews-tab" data-bs-toggle="tab" 
                    data-bs-target="#reviews-tab-pane" type="button" role="tab" 
                    aria-controls="reviews-tab-pane" aria-selected="false">
                Đánh giá
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
                        {{ count($course['lessons']) }} bài học • {{ $formattedTotalDuration }}
                    </p>
                </div>
                <div class="list-group list-group-flush">
                    @foreach($course['lessons'] as $index => $lesson)
                        <div class="list-group-item p-4 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    @if($lesson['completed'] ?? false)
                                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="bi bi-check-circle text-success"></i>
                                        </div>
                                    @else
                                        <div class="bg-light rounded-circle p-2 me-3" style="width: 40px; height: 40px;">
                                            <span class="d-flex align-items-center justify-content-center fw-medium">
                                                {{ $index + 1 }}
                                            </span>
                                        </div>
                                    @endif
                                    <div>
                                        <h5 class="fw-medium mb-1">{{ $lesson['title'] }}</h5>
                                        <div class="d-flex align-items-center text-muted small">
                                            <i class="bi bi-clock me-1"></i>
                                            <span>{{ $lesson['duration'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if($course['enrolled'] ?? false)
                                    <a href="{{ route('lessons.show', [$course['id'], $lesson['id']]) }}" 
                                       class="btn {{ $lesson['completed'] ? 'btn-outline-primary' : 'btn-primary' }} btn-sm">
                                        {{ $lesson['completed'] ? 'Xem lại' : 'Bắt đầu' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Assignments Tab -->
        <div class="tab-pane fade" id="assignments-tab-pane" role="tabpanel" 
             aria-labelledby="assignments-tab" tabindex="0">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-bottom">
                    <h4 class="fw-semibold mb-1">Bài tập</h4>
                    <p class="text-muted mb-0">{{ count($course['assignments']) }} b��i tập</p>
                </div>
                <div class="list-group list-group-flush">
                    @foreach($course['assignments'] as $assignment)
                        <div class="list-group-item p-4 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-medium mb-2">{{ $assignment['title'] }}</h5>
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-calendar me-1"></i>
                                        Hạn nộp: {{ \Carbon\Carbon::parse($assignment['dueDate'])->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div>
                                    @if($assignment['completed'] ?? false)
                                        <span class="badge bg-success p-2">
                                            <i class="bi bi-check-circle me-1"></i> Đã nộp
                                        </span>
                                    @else
                                        <a href="{{ route('assignments.show', $assignment['id']) }}" 
                                           class="btn btn-primary btn-sm">
                                            Xem chi tiết
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Reviews Tab -->
        <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" 
             aria-labelledby="reviews-tab" tabindex="0">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-semibold mb-0">Đánh giá từ học viên</h4>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="display-6 fw-bold me-2">{{ $course['rating'] }}</span>
                                <div class="d-flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $course['rating'] ? '-fill' : '' }} text-warning"></i>
                                    @endfor
                                </div>
                            </div>
                            <span class="text-muted">{{ count($course['reviews']) }} đánh giá</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if(count($course['reviews']) > 0)
                        <div class="d-flex flex-column gap-4">
                            @foreach($course['reviews'] as $review)
                                <div class="border-bottom pb-4">
                                    <div class="d-flex mb-3">
                                        <img src="{{ $review['avatar'] ?? asset('images/avatar-placeholder.jpg') }}" 
                                             alt="{{ $review['user'] }}" class="rounded-circle me-3" 
                                             style="width: 48px; height: 48px; object-fit: cover;">
                                        <div>
                                            <h5 class="fw-medium mb-1">{{ $review['user'] }}</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="bi bi-star{{ $i <= $review['rating'] ? '-fill' : '' }} text-warning small"></i>
                                                    @endfor
                                                </div>
                                                <span class="text-muted small">
                                                    {{ \Carbon\Carbon::parse($review['date'])->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-0">{{ $review['content'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Chưa có đánh giá nào cho khóa học này</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Instructor Tab -->
        <div class="tab-pane fade" id="instructor-tab-pane" role="tabpanel" 
             aria-labelledby="instructor-tab" tabindex="0">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row gap-4">
                        <div class="text-center">
                            <img src="{{ $course['instructor']['avatar'] ?? asset('images/avatar-placeholder.jpg') }}" 
                                 alt="{{ $course['instructor']['name'] }}" 
                                 class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                            <h4 class="fw-semibold mb-1">{{ $course['instructor']['name'] }}</h4>
                            <p class="text-muted">{{ $course['instructor']['title'] }}</p>
                        </div>
                        <div>
                            <h5 class="fw-semibold mb-3">Giới thiệu</h5>
                            <p>{{ $course['instructor']['bio'] }}</p>
                            
                            <h5 class="fw-semibold mb-3 mt-4">Chuyên môn</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-light text-dark p-2">PHP</span>
                                <span class="badge bg-light text-dark p-2">Laravel</span>
                                <span class="badge bg-light text-dark p-2">Web Development</span>
                                <span class="badge bg-light text-dark p-2">Database Design</span>
                                <span class="badge bg-light text-dark p-2">API Development</span>
                            </div>
                        </div>
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
