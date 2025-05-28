@if($displayType == 'grid')
<div class="row g-4">
    @foreach($categories as $slug => $name)
    <div class="col-lg-2 col-md-4 col-6">
        <a href="{{ route('courses.category', $slug) }}" class="text-decoration-none">
            <div class="card 
                @if(strpos(\App\Helpers\CategoryHelper::getCategoryIcon($slug), 'primary') !== false) bg-primary 
                @elseif(strpos(\App\Helpers\CategoryHelper::getCategoryIcon($slug), 'success') !== false) bg-success 
                @elseif(strpos(\App\Helpers\CategoryHelper::getCategoryIcon($slug), 'danger') !== false) bg-danger 
                @elseif(strpos(\App\Helpers\CategoryHelper::getCategoryIcon($slug), 'warning') !== false) bg-warning 
                @elseif(strpos(\App\Helpers\CategoryHelper::getCategoryIcon($slug), 'info') !== false) bg-info 
                @else bg-secondary @endif 
                bg-opacity-10 border-0 h-100 text-center">
                <div class="card-body py-4">
                    <div class="mb-3">
                        <i class="bi {{ \App\Helpers\CategoryHelper::getCategoryIcon($slug) }}" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="fw-semibold">{{ $name }}</h5>
                    <p class="small text-muted mb-0">{{ $categoryCounts[$slug] }} khóa học</p>
                </div>
            </div>
        </a>
    </div>
    @endforeach
    
    <div class="col-lg-2 col-md-4 col-6">
        <a href="{{ route('courses.index') }}" class="text-decoration-none">
            <div class="card bg-secondary bg-opacity-10 border-0 h-100 text-center">
                <div class="card-body py-4">
                    <div class="mb-3">
                        <i class="bi bi-grid-3x3-gap text-secondary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="fw-semibold">Tất cả</h5>
                    <p class="small text-muted mb-0">{{ $totalCourses }} khóa học</p>
                </div>
            </div>
        </a>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="list-group">
            @foreach($categories as $slug => $name)
            <a href="{{ route('courses.category', $slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi {{ \App\Helpers\CategoryHelper::getCategoryIcon($slug) }} me-2"></i>
                    {{ $name }}
                </div>
                <span class="badge bg-primary rounded-pill">{{ $categoryCounts[$slug] }}</span>
            </a>
            @endforeach
            <a href="{{ route('courses.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <i class="bi bi-grid-3x3-gap text-secondary me-2"></i>
                    Tất cả khóa học
                </div>
                <span class="badge bg-primary rounded-pill">{{ $totalCourses }}</span>
            </a>
        </div>
    </div>
</div>
@endif