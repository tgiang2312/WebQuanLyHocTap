@extends('layouts.app')

@section('title', 'Bảng điều khiển - LearnHub')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">Bảng điều khiển</h1>
    
    <!-- Overview Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-book fs-4 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Khóa học đang học</p>
                        <h3 class="fw-bold mb-0">3</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-check-circle fs-4 text-success"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Khóa học đã hoàn thành</p>
                        <h3 class="fw-bold mb-0">1</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-file-text fs-4 text-warning"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Bài tập đang chờ</p>
                        <h3 class="fw-bold mb-0">2</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Continue Learning Section -->
    <h2 class="fw-semibold mb-4">Tiếp tục học tập</h2>
    <div class="row g-4 mb-5">
        @foreach($enrolledCourses as $course)
            @if(!($course['completed'] ?? false))
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $course['image'] ?? asset('images/placeholder.jpg') }}" 
                                     alt="{{ $course['title'] }}" class="img-fluid h-100" style="object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <span class="badge bg-primary mb-2">{{ $course['category'] }}</span>
                                            <h4 class="fw-semibold mb-1">{{ $course['title'] }}</h4>
                                            <p class="text-muted mb-3">{{ $course['instructor'] }}</p>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#">Đánh dấu hoàn thành</a></li>
                                                <li><a class="dropdown-item" href="#">Xem thông tin khóa học</a></li>
                                                <li><a class="dropdown-item" href="#">Hủy đăng ký</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span>Tiến độ</span>
                                            <span>{{ $course['progress'] }}%</span>
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-primary" role="progressbar" 
                                                 style="width: {{ $course['progress'] }}%" 
                                                 aria-valuenow="{{ $course['progress'] }}" 
                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center text-muted mb-3">
                                        <i class="bi bi-clock me-2"></i>
                                        <span class="small">Bài học gần nhất: {{ $course['lastLesson'] }}</span>
                                    </div>
                                    
                                    <a href="{{ route('courses.learn', $course['id']) }}" class="btn btn-primary w-100">
                                        <i class="bi bi-play-fill me-2"></i> Tiếp tục học
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    
    <!-- My Courses Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold mb-0">Khóa học của tôi</h2>
        <a href="{{ route('dashboard.courses') }}" class="text-decoration-none text-primary">
            Xem tất cả
        </a>
    </div>
    
    <div class="row g-4 mb-5">
        @foreach($enrolledCourses as $course)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 course-card">
                    <div class="position-relative">
                        <img src="{{ $course['image'] ?? asset('images/placeholder.jpg') }}" 
                             alt="{{ $course['title'] }}" class="card-img-top" 
                             style="height: 160px; object-fit: cover;">
                             
                        @if($course['completed'] ?? false)
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-60 
                                        d-flex align-items-center justify-content-center">
                                <span class="badge bg-success px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i> Đã hoàn thành
                                </span>
                            </div>
                        @endif
                        
                        <span class="position-absolute top-0 end-0 badge bg-primary m-2">
                            {{ $course['category'] }}
                        </span>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-2">{{ $course['title'] }}</h5>
                        <p class="card-text text-muted mb-3">{{ $course['instructor'] }}</p>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>Tiến độ</span>
                                <span>{{ $course['progress'] }}%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" 
                                     style="width: {{ $course['progress'] }}%" 
                                     aria-valuenow="{{ $course['progress'] }}" 
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white border-top">
                        <a href="{{ route('courses.learn', $course['id']) }}" 
                           class="btn {{ ($course['completed'] ?? false) ? 'btn-outline-primary' : 'btn-primary' }} w-100">
                            {{ ($course['completed'] ?? false) ? 'Xem lại khóa học' : 'Tiếp tục học' }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Assignments and Achievements Section -->
    <div class="row g-4">
        <!-- Upcoming Assignments -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-semibold mb-0 d-flex align-items-center">
                        <i class="bi bi-file-text me-2"></i> Bài tập sắp đến hạn
                    </h4>
                </div>
                <div class="card-body">
                    @if(count($upcomingAssignments) > 0)
                        <div class="d-flex flex-column gap-3">
                            @foreach($upcomingAssignments as $assignment)
                                <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                    <div>
                                        <h5 class="fw-medium mb-1">{{ $assignment['title'] }}</h5>
                                        <p class="text-muted small mb-0">{{ $assignment['course'] }}</p>
                                    </div>
                                    <div class="text-end">
                                        <p class="text-danger fw-medium small mb-1">
                                            Hạn nộp: {{ \Carbon\Carbon::parse($assignment['dueDate'])->format('d/m/Y') }}
                                        </p>
                                        <a href="{{ route('assignments.show', $assignment['id']) }}" 
                                           class="text-primary small text-decoration-none">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Không có bài tập nào sắp đến hạn</p>
                    @endif
                </div>
                <div class="card-footer bg-white border-top py-3">
                    <a href="{{ route('assignments.index') }}" class="btn btn-outline-primary w-100">
                        Xem tất cả bài tập
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Achievements -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-semibold mb-0 d-flex align-items-center">
                        <i class="bi bi-trophy me-2"></i> Thành tích của tôi
                    </h4>
                </div>
                <div class="card-body">
                    @if(count($achievements) > 0)
                        <div class="d-flex flex-column gap-3">
                            @foreach($achievements as $achievement)
                                <div class="d-flex align-items-center p-3 bg-light rounded">
                                    <div class="fs-2 me-3">{{ $achievement['icon'] }}</div>
                                    <div>
                                        <h5 class="fw-medium mb-1">{{ $achievement['title'] }}</h5>
                                        <p class="text-muted small mb-0">
                                            Đạt được vào {{ \Carbon\Carbon::parse($achievement['date'])->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Chưa có thành tích nào</p>
                    @endif
                </div>
                <div class="card-footer bg-white border-top py-3">
                    <a href="{{ route('achievements.index') }}" class="btn btn-outline-primary w-100">
                        Xem tất cả thành tích
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add animation to cards on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.course-card');
        
        // Add hover effect
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('shadow');
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.classList.remove('shadow');
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection

@section('styles')
<style>
    .course-card {
        transition: all 0.3s ease;
    }
</style>
@endsection
