@extends('layouts.app')

@section('title', 'Khóa học {{ $category }} - LearnHub')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="fw-bold mb-3">Khóa học {{ $category }}</h1>
            <p class="lead">Khám phá các khóa học {{ $category }} từ những giáo viên giàu kinh nghiệm</p>
        </div>
    </div>
    
    <!-- Breadcrumb -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" class="text-decoration-none">Khóa học</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category }}</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <!-- Search & Filter -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('courses.index') }}" method="GET" class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm khóa học {{ $category }}..." name="search" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="category" value="{{ Str::slug($category) }}">
                        <div class="col-md-4">
                            <select name="sort" class="form-select">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ biến</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Đánh giá cao</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Course Listings -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="fw-bold mb-0">Khóa học {{ $category }}</h3>
            <p class="text-muted mb-0">Hiển thị {{ $courses->count() }} khóa học</p>
        </div>
    </div>
    
    @if ($courses->count() > 0)
        <div class="row g-4">
            @foreach ($courses as $course)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        @if ($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" class="card-img-top" alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light text-center py-5">
                                <i class="bi bi-image text-secondary" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-primary">{{ $course->category ?? $category }}</span>
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
            <i class="bi bi-info-circle fs-3 d-block mb-3"></i>
            <p class="mb-3">Không tìm thấy khóa học nào trong danh mục "{{ $category }}".</p>
            <a href="{{ route('courses.index') }}" class="btn btn-primary">Xem tất cả khóa học</a>
        </div>
    @endif
    
    <!-- Related Categories -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="fw-bold mb-4">Danh mục khác</h3>
            <div class="row g-4">
                @php
                    $categories = [
                        ['name' => 'Lập trình', 'slug' => 'lap-trinh', 'icon' => 'bi-code-square', 'color' => 'primary'],
                        ['name' => 'Marketing', 'slug' => 'marketing', 'icon' => 'bi-graph-up', 'color' => 'success'],
                        ['name' => 'Thiết kế', 'slug' => 'thiet-ke', 'icon' => 'bi-brush', 'color' => 'danger'],
                        ['name' => 'Kinh doanh', 'slug' => 'kinh-doanh', 'icon' => 'bi-briefcase', 'color' => 'warning'],
                        ['name' => 'Ngoại ngữ', 'slug' => 'ngoai-ngu', 'icon' => 'bi-translate', 'color' => 'info']
                    ];
                @endphp
                
                @foreach($categories as $cat)
                    @if(strtolower($cat['name']) != strtolower($category))
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('courses.category', $cat['slug']) }}" class="text-decoration-none">
                                <div class="card bg-{{ $cat['color'] }} bg-opacity-10 border-0 h-100">
                                    <div class="card-body p-4 text-center">
                                        <i class="bi {{ $cat['icon'] }} text-{{ $cat['color'] }} fs-1 mb-3"></i>
                                        <h5 class="fw-semibold">{{ $cat['name'] }}</h5>
                                        <p class="mb-0 mt-2">
                                            <span class="btn btn-sm btn-outline-{{ $cat['color'] }}">Khám phá</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 