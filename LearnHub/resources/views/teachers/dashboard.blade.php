@extends('layouts.app')

@section('title', 'Bảng điều khiển Giảng viên - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Bảng điều khiển Giảng viên</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tạo khóa học mới
        </a>
    </div>
    
    @php
        $myCreatedCourses = App\Models\Course::where('teacher_id', Auth::id())->latest()->get();
        $totalStudents = 0;
        
        // Tính tổng số học viên từ tất cả khóa học của giảng viên
        foreach($myCreatedCourses as $course) {
            $totalStudents += $course->enrollments()->count();
        }
    @endphp
    
    <!-- Teacher Overview Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-mortarboard-fill fs-4 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Tổng khóa học</p>
                        <h3 class="fw-bold mb-0">{{ $myCreatedCourses->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-people-fill fs-4 text-success"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Tổng học viên</p>
                        <h3 class="fw-bold mb-0">{{ $totalStudents }}</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-star-fill fs-4 text-info"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Đánh giá trung bình</p>
                        <h3 class="fw-bold mb-0">4.8<small class="text-muted fs-6">/5</small></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- My Created Courses Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold mb-0">Khóa học tôi đã tạo</h2>
        <a href="{{ route('teachers.courses') }}" class="text-decoration-none text-primary">
            Xem tất cả
        </a>
    </div>
    
    <div class="row g-4 mb-5">
        @if($myCreatedCourses->count() > 0)
            @foreach($myCreatedCourses->take(6) as $course)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 course-card">
                        <div class="position-relative">
                            <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('images/placeholder.jpg') }}" 
                                 alt="{{ $course->title }}" class="card-img-top" 
                                 style="height: 160px; object-fit: cover;">
                            
                            <span class="position-absolute top-0 end-0 badge {{ $course->status == 'published' ? 'bg-success' : 'bg-warning' }} m-2">
                                {{ $course->status == 'published' ? 'Đã xuất bản' : 'Bản nháp' }}
                            </span>
                        </div>
                        
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">{{ $course->category }}</span>
                            <h5 class="card-title fw-semibold mb-2">{{ $course->title }}</h5>
                            <p class="card-text text-muted small mb-3">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                            
                            <div class="d-flex align-items-center justify-content-between text-muted small">
                                <span><i class="bi bi-people-fill me-1"></i> {{ $course->enrollments()->count() }} học viên</span>
                                <span><i class="bi bi-book me-1"></i> {{ $course->lessons()->count() }} bài học</span>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-top">
                            <div class="d-flex gap-2">
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary flex-grow-1">
                                    <i class="bi bi-eye me-1"></i> Xem
                                </a>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-secondary flex-grow-1">
                                    <i class="bi bi-pencil me-1"></i> Sửa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    <p class="mb-0">Bạn chưa tạo khóa học nào. Nhấn vào "Tạo khóa học mới" để bắt đầu.</p>
                </div>
            </div>
        @endif
    </div>
    
    <!-- Recent Activities and Student Performance -->
    <div class="row g-4">
        <!-- Recent Activities -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-semibold mb-0 d-flex align-items-center">
                        <i class="bi bi-activity me-2"></i> Hoạt động gần đây
                    </h4>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item mb-4 position-relative ps-4">
                            <div class="timeline-marker"></div>
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <p class="fw-medium mb-1">Nguyễn Văn A đã đăng ký khóa học</p>
                                    <small class="text-muted">1 giờ trước</small>
                                </div>
                                <p class="text-muted mb-0">Lập trình web với Laravel</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item mb-4 position-relative ps-4">
                            <div class="timeline-marker"></div>
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <p class="fw-medium mb-1">Trần Thị B đã nộp bài tập</p>
                                    <small class="text-muted">2 giờ trước</small>
                                </div>
                                <p class="text-muted mb-0">Bài tập 1: Xây dựng website bán hàng</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item mb-4 position-relative ps-4">
                            <div class="timeline-marker"></div>
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <p class="fw-medium mb-1">Lê Văn C đã hoàn thành khóa học</p>
                                    <small class="text-muted">5 giờ trước</small>
                                </div>
                                <p class="text-muted mb-0">Digital Marketing cơ bản</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top py-3">
                    <a href="{{ route('teachers.activities') }}" class="btn btn-outline-primary w-100">
                        Xem tất cả hoạt động
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Student Performance -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-semibold mb-0 d-flex align-items-center">
                        <i class="bi bi-graph-up me-2"></i> Hiệu suất học viên
                    </h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center h-100 py-4">
                        <p class="text-muted">Biểu đồ hiệu suất học viên sẽ được hiển thị ở đây</p>
                    </div>
                </div>
                <div class="card-footer bg-white border-top py-3">
                    <a href="{{ route('teachers.analytics') }}" class="btn btn-outline-primary w-100">
                        Xem báo cáo chi tiết
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Assignments Management -->
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-semibold mb-0">Quản lý bài tập</h2>
            <a href="{{ route('teachers.assignments.create') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-plus-circle me-2"></i> Tạo bài tập mới
            </a>
        </div>
        
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Tên bài tập</th>
                                <th scope="col">Khóa học</th>
                                <th scope="col">Đã nộp</th>
                                <th scope="col">Hạn nộp</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bài tập 1: Thiết kế giao diện</td>
                                <td>UI/UX Design</td>
                                <td>15/30</td>
                                <td>30/06/2025</td>
                                <td><span class="badge bg-success">Đang mở</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-outline-primary">Xem</a>
                                        <a href="#" class="btn btn-outline-secondary">Sửa</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bài tập 2: Thiết kế cơ sở dữ liệu</td>
                                <td>Web Backend</td>
                                <td>8/25</td>
                                <td>15/07/2025</td>
                                <td><span class="badge bg-success">Đang mở</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-outline-primary">Xem</a>
                                        <a href="#" class="btn btn-outline-secondary">Sửa</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bài tập 3: Xây dựng API</td>
                                <td>RESTful API</td>
                                <td>0/20</td>
                                <td>10/08/2025</td>
                                <td><span class="badge bg-warning">Bản nháp</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-outline-primary">Xem</a>
                                        <a href="#" class="btn btn-outline-secondary">Sửa</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white py-3">
                <a href="{{ route('teachers.assignments') }}" class="btn btn-outline-primary w-100">
                    Xem tất cả bài tập
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
        
        // Hiệu ứng timeline
        document.querySelectorAll('.timeline-marker').forEach(function(marker) {
            marker.style.left = '-10px';
            marker.style.top = '12px';
            marker.style.width = '20px';
            marker.style.height = '20px';
            marker.style.borderRadius = '50%';
            marker.style.backgroundColor = '#0d6efd';
            marker.style.position = 'absolute';
        });
        
        document.querySelectorAll('.timeline-item').forEach(function(item) {
            item.style.borderLeft = '2px solid #dee2e6';
        });
    });
</script>
@endsection

@section('styles')
<style>
    .course-card {
        transition: all 0.3s ease;
    }
    
    .timeline {
        position: relative;
        padding-left: 10px;
    }
    
    .timeline-item {
        position: relative;
        padding-left: 20px;
        margin-bottom: 20px;
    }
</style>
@endsection 