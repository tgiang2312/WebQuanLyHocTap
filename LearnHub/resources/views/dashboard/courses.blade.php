@extends('layouts.app')

@section('title', 'Khóa học của tôi - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0">Khóa học của tôi</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-2"></i> Quay lại bảng điều khiển
        </a>
    </div>
    
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="fw-semibold mb-0">Tất cả khóa học</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-3 justify-content-md-end mt-3 mt-md-0">
                                <select class="form-select w-auto">
                                    <option value="all">Tất cả trạng thái</option>
                                    <option value="in-progress">Đang học</option>
                                    <option value="completed">Đã hoàn thành</option>
                                </select>
                                <select class="form-select w-auto">
                                    <option value="all">Tất cả danh mục</option>
                                    <option value="web">Web</option>
                                    <option value="programming">Lập trình</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 ps-4">Khóa học</th>
                                    <th class="py-3">Giảng viên</th>
                                    <th class="py-3">Tiến độ</th>
                                    <th class="py-3">Trạng thái</th>
                                    <th class="py-3 text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enrolledCourses as $course)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $course['image'] ?? asset('images/placeholder.jpg') }}" 
                                                     alt="{{ $course['title'] }}" class="me-3" 
                                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                                <div>
                                                    <h6 class="fw-semibold mb-1">{{ $course['title'] }}</h6>
                                                    <span class="badge bg-primary">{{ $course['category'] }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $course['instructor'] }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" 
                                                         style="width: {{ $course['progress'] }}%" 
                                                         aria-valuenow="{{ $course['progress'] }}" 
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span>{{ $course['progress'] }}%</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($course['completed'] ?? false)
                                                <span class="badge bg-success">Đã hoàn thành</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Đang học</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('courses.learn', $course['id']) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="bi bi-play-fill me-1"></i> Học
                                                </a>
                                                <a href="{{ route('courses.show', $course['id']) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-info-circle"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <p class="text-muted mb-0">Bạn chưa đăng ký khóa học nào</p>
                                            <a href="{{ route('courses.index') }}" class="btn btn-primary mt-3">
                                                Khám phá khóa học
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 