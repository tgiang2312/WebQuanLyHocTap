@extends('layouts.app')

@section('title', 'Danh sách khóa học - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="fw-bold mb-3">Khóa học</h1>
            <p class="lead">Khám phá các khóa học chất lượng từ những giáo viên giàu kinh nghiệm</p>
        </div>
    </div>
    
    <!-- Search & Filter -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('courses.index') }}" method="GET" class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm khóa học..." name="search" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-select">
                                <option value="">Tất cả danh mục</option>
                                <option value="lap-trinh" {{ request('category') == 'lap-trinh' ? 'selected' : '' }}>Lập trình</option>
                                <option value="marketing" {{ request('category') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="thiet-ke" {{ request('category') == 'thiet-ke' ? 'selected' : '' }}>Thiết kế</option>
                                <option value="kinh-doanh" {{ request('category') == 'kinh-doanh' ? 'selected' : '' }}>Kinh doanh</option>
                                <option value="ngoai-ngu" {{ request('category') == 'ngoai-ngu' ? 'selected' : '' }}>Ngoại ngữ</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="sort" class="form-select">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ biến</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Course Categories -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="fw-bold mb-4">Danh mục khóa học</h3>
            <div class="row g-4">
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.category', 'lap-trinh') }}" class="text-decoration-none">
                        <div class="card bg-primary bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <i class="bi bi-code-square text-primary fs-1 mb-3"></i>
                                <h5 class="fw-semibold">Lập trình</h5>
                                <p class="small text-muted mb-0">25 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.category', 'marketing') }}" class="text-decoration-none">
                        <div class="card bg-success bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <i class="bi bi-graph-up text-success fs-1 mb-3"></i>
                                <h5 class="fw-semibold">Marketing</h5>
                                <p class="small text-muted mb-0">18 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.category', 'thiet-ke') }}" class="text-decoration-none">
                        <div class="card bg-danger bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <i class="bi bi-brush text-danger fs-1 mb-3"></i>
                                <h5 class="fw-semibold">Thiết kế</h5>
                                <p class="small text-muted mb-0">15 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.category', 'kinh-doanh') }}" class="text-decoration-none">
                        <div class="card bg-warning bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <i class="bi bi-briefcase text-warning fs-1 mb-3"></i>
                                <h5 class="fw-semibold">Kinh doanh</h5>
                                <p class="small text-muted mb-0">12 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.category', 'ngoai-ngu') }}" class="text-decoration-none">
                        <div class="card bg-info bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <i class="bi bi-translate text-info fs-1 mb-3"></i>
                                <h5 class="fw-semibold">Ngoại ngữ</h5>
                                <p class="small text-muted mb-0">20 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.index') }}" class="text-decoration-none">
                        <div class="card bg-secondary bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <i class="bi bi-grid text-secondary fs-1 mb-3"></i>
                                <h5 class="fw-semibold">Tất cả</h5>
                                <p class="small text-muted mb-0">90 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
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
                        @if ($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" class="card-img-top" alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light text-center py-5">
                                <i class="bi bi-image text-secondary" style="font-size: 4rem;"></i>
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