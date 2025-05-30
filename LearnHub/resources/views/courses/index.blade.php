@extends('layouts.app')

@section('title', 'Danh sách khóa học - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="fw-bold mb-3">Khóa học</h1>
            <p class="lead">Khám phá các khóa học chất lượng từ những giáo viên giàu kinh nghiệm</p>
            @auth
                @if(Auth::user()->isTeacher() || Auth::user()->isAdmin())
                <div class="mt-4">
                    <a href="{{ route('courses.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Tạo khóa học mới
                    </a>
                </div>
                @endif
            @endauth
        </div>
    </div>
    
    <!-- Search & Filter -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-3">Tìm kiếm khóa học</h4>
                    <x-course-search :filters="['category', 'sort']" :show-advanced="true" />
                </div>
            </div>
        </div>
    </div>
    
    <!-- Course Categories -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="fw-bold mb-4">Danh mục khóa học</h3>
            <x-category-list display-type="grid" />
        </div>
    </div>
    
    <!-- Course Listings -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Tất cả khóa học</h3>
        </div>
    </div>
    
    @if ($courses->count() > 0)
        <div class="row g-4">
            @foreach ($courses as $course)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        @if ($course->image_data || $course->image)
                            <img src="{{ $course->imageUrl }}" class="card-img-top" alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div style="background-image: url('{{ asset('images/logo-background.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: center; height: 200px; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: flex-end; align-items: center;">
                                <div style="background-color: #0d6efd; color: white; padding: 8px 15px; border-radius: 8px; margin-bottom: 15px; max-width: 90%; text-align: center;">
                                    <span style="font-weight: bold;">{{ $course->title }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-primary">{{ $course->category ?? 'Khóa học' }}</span>
                                <span class="text-muted small">
                                    <i class="bi bi-people-fill me-1"></i> {{ $course->students->count() ?? 0 }} học viên
                                </span>
                            </div>
                            <h5 class="card-title fw-bold mb-3">{{ $course->title }}</h5>
                            <p class="text-muted mb-3">{{ Str::limit($course->description, 100) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $course->teacher->avatar ? Storage::url($course->teacher->avatar) : asset('images/default-avatar.png') }}" alt="{{ $course->teacher->name }}" class="rounded-circle me-2" width="30" height="30">
                                    <span class="small">{{ $course->teacher->name }}</span>
                                </div>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 pt-0">
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-primary d-block">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center py-4">
            <i class="bi bi-info-circle fs-3 mb-3"></i>
            <p class="mb-0">Không tìm thấy khóa học nào. Vui lòng thử lại với tiêu chí tìm kiếm khác.</p>
        </div>
    @endif
</div>
@endsection 