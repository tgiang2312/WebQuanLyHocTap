@extends('layouts.app')

@section('title', 'Khóa học của tôi - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Khóa học của tôi</h1>
        <a href="{{ route('courses.index') }}" class="btn btn-primary">
            <i class="bi bi-grid me-2"></i> Khám phá thêm khóa học
        </a>
    </div>
    
    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('students.courses') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="in_progress">Đang học</option>
                        <option value="completed">Đã hoàn thành</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="category" class="form-label">Danh mục</label>
                    <select id="category" name="category" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="programming">Lập trình</option>
                        <option value="design">Thiết kế</option>
                        <option value="marketing">Marketing</option>
                        <option value="business">Kinh doanh</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sort" class="form-label">Sắp xếp theo</label>
                    <select id="sort" name="sort" class="form-select">
                        <option value="newest">Mới nhất</option>
                        <option value="oldest">Cũ nhất</option>
                        <option value="progress">Tiến độ</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-filter me-2"></i> Lọc
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Courses List -->
    <div class="row g-4">
        @foreach($enrolledCourses as $course)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 course-card">
                    <div class="position-relative">
                        <img src="{{ isset($course['imageUrl']) ? $course['imageUrl'] : ($course['image'] ?? asset('images/placeholder.jpg')) }}" 
                             alt="{{ $course['title'] }}" class="card-img-top" 
                             style="height: 180px; object-fit: cover;">
                             
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
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold mb-2">{{ $course['title'] }}</h5>
                        <p class="text-muted mb-2">Giảng viên: {{ $course['instructor'] }}</p>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>Tiến độ</span>
                                <span>{{ $course['progress'] }}%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-primary course-progress-bar" 
                                     role="progressbar" 
                                     data-progress="{{ $course['progress'] }}"
                                     aria-valuenow="{{ $course['progress'] }}" 
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-between text-muted small mb-3">
                            <span><i class="bi bi-clock me-1"></i> {{ $course['duration'] ?? 'N/A' }}</span>
                            <span><i class="bi bi-calendar me-1"></i> {{ $course['enrolled_date'] ?? 'N/A' }}</span>
                        </div>
                        
                        <div class="mt-auto">
                            <div class="d-grid gap-2">
                                <a href="{{ route('courses.learn', $course['id']) }}" 
                                   class="btn {{ ($course['completed'] ?? false) ? 'btn-outline-primary' : 'btn-primary' }}">
                                    {{ ($course['completed'] ?? false) ? '<i class="bi bi-arrow-repeat me-2"></i> Xem lại' : '<i class="bi bi-play-fill me-2"></i> Tiếp tục học' }}
                                </a>
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                    Tùy chọn
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li><a class="dropdown-item" href="{{ route('courses.show', $course['id']) }}">Xem thông tin khóa học</a></li>
                                    <li><a class="dropdown-item" href="#">Tải chứng chỉ</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#">Hủy đăng ký</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        <nav aria-label="Phân trang">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Trước</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Sau</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Thiết lập chiều rộng cho các thanh tiến trình
        document.querySelectorAll('.course-progress-bar').forEach(function(bar) {
            const progress = bar.getAttribute('data-progress');
            if (progress) {
                bar.style.width = progress + '%';
            }
        });

        // Hiệu ứng hover cho card
        document.querySelectorAll('.course-card').forEach(function(card) {
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