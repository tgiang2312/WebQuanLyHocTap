@extends('layouts.app')

@section('title', 'Khóa học {{ $subcategory }} - {{ $category }} - LearnHub')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="fw-bold mb-3">{{ $subcategory }}</h1>
            <p class="lead">Khám phá các khóa học {{ $subcategory }} từ những giáo viên giàu kinh nghiệm</p>
        </div>
    </div>
    
    <!-- Breadcrumb -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" class="text-decoration-none">Khóa học</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.category', $categorySlug) }}" class="text-decoration-none">{{ $category }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subcategory }}</li>
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
                            <div class="input-group search-form">
                                <input type="text" class="form-control" placeholder="Tìm kiếm khóa học {{ $subcategory }}..." name="search" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search me-1"></i> Tìm kiếm
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="category" value="{{ $categorySlug }}">
                        <input type="hidden" name="subcategory" value="{{ $subcategorySlug }}">
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
            <h3 class="fw-bold mb-0">Khóa học {{ $subcategory }}</h3>
            <p class="text-muted mb-0">Hiển thị {{ $courses->count() }} khóa học</p>
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
                                <span class="badge bg-primary">{{ $course->subcategory ?? $subcategory }}</span>
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
            <p class="mb-3">Không tìm thấy khóa học nào trong danh mục "{{ $subcategory }}".</p>
            <a href="{{ route('courses.category', $categorySlug) }}" class="btn btn-primary">Xem tất cả khóa học {{ $category }}</a>
        </div>
    @endif
    
    <!-- Other Subcategories -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="fw-bold mb-4">Các danh mục con khác của {{ $category }}</h3>
            <div class="row g-4">
                @foreach(\App\Helpers\CategoryHelper::getSubcategoriesForCategory($categorySlug) as $slug => $name)
                    @if($name != $subcategory)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('courses.subcategory', [$categorySlug, $slug]) }}" class="text-decoration-none">
                                <div class="card bg-light bg-opacity-75 border-0 h-100">
                                    <div class="card-body p-4 text-center">
                                        <div class="mb-3">
                                            <i class="bi {{ \App\Helpers\CategoryHelper::getSubcategoryIcon($categorySlug, $slug) }}" style="font-size: 2rem;"></i>
                                        </div>
                                        <h5 class="fw-semibold">{{ $name }}</h5>
                                        <p class="mb-0 mt-2">
                                            <span class="btn btn-sm btn-outline-primary">Khám phá</span>
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