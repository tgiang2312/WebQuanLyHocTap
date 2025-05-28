@extends('layouts.app')

@section('title', 'Kết quả tìm kiếm - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <h1 class="fw-bold mb-3">Kết quả tìm kiếm</h1>
            @if(!empty($searchTerm))
                <p class="lead">Kết quả tìm kiếm cho "{{ $searchTerm }}"</p>
            @else
                <p class="lead">Tất cả khóa học phù hợp</p>
            @endif
        </div>
    </div>
    
    <!-- Search & Filter -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <x-course-search :search-term="$searchTerm" :filters="['category', 'sort']" :show-advanced="true" />
                </div>
            </div>
        </div>
    </div>
    
    <!-- Advanced Filters -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Bộ lọc nâng cao</h5>
                    <form action="{{ route('courses.search') }}" method="GET" class="row g-3">
                        <input type="hidden" name="search" value="{{ $searchTerm ?? '' }}">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif
                        
                        <div class="col-md-6">
                            <label class="form-label">Cấp độ</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="level" id="level-all" value="" {{ request('level') == '' || !request('level') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="level-all">Tất cả</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="level" id="level-beginner" value="beginner" {{ request('level') == 'beginner' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="level-beginner">Cơ bản</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="level" id="level-intermediate" value="intermediate" {{ request('level') == 'intermediate' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="level-intermediate">Trung cấp</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="level" id="level-advanced" value="advanced" {{ request('level') == 'advanced' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="level-advanced">Nâng cao</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary">Áp dụng bộ lọc</button>
                            <a href="{{ route('courses.search') }}" class="btn btn-outline-secondary ms-2">Xóa bộ lọc</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Course Listings -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold">Kết quả ({{ $courses->count() }} khóa học)</h3>
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
                            <div class="bg-light text-center py-5">
                                <i class="bi bi-image text-secondary" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-primary">{{ $course->category ?? 'Khóa học' }}</span>
                                <span class="badge bg-secondary">{{ __('levels.' . $course->level) }}</span>
                            </div>
                            <h5 class="card-title fw-bold mb-3">{{ $course->title }}</h5>
                            <p class="text-muted mb-3">{{ Str::limit($course->description, 100) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $course->teacher->avatar ? Storage::url($course->teacher->avatar) : asset('images/default-avatar.png') }}" alt="{{ $course->teacher->name }}" class="rounded-circle me-2" width="30" height="30">
                                    <span class="small">{{ $course->teacher->name }}</span>
                                </div>
                                <div>
                                    <span class="fw-bold">{{ number_format($course->price, 0, ',', '.') }}đ</span>
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
            <i class="bi bi-info-circle fs-3 mb-3 d-block"></i>
            <p class="mb-0">Không tìm thấy khóa học nào. Vui lòng thử lại với tiêu chí tìm kiếm khác.</p>
        </div>
    @endif
</div>
@endsection 