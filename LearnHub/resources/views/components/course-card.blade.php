<div class="card h-100 border-0 shadow-sm course-card">
    <div class="position-relative">
        <img src="{{ $course['image'] ?? asset('images/placeholder.jpg') }}" 
             alt="{{ $course['title'] }}" class="card-img-top" style="height: 180px; object-fit: cover;">
        <span class="position-absolute top-0 end-0 badge bg-primary m-2">
            {{ $course['category'] }}
        </span>
    </div>
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-2">{{ $course['title'] }}</h5>
        <p class="card-text text-muted mb-2">{{ $course['instructor'] }}</p>
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-star-fill text-warning me-1"></i>
            <span class="fw-medium me-1">{{ $course['rating'] }}</span>
            <span class="text-muted">({{ $course['students'] }})</span>
        </div>
    </div>
    <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center text-muted">
            <i class="bi bi-clock me-1"></i>
            <span class="small">{{ $course['duration'] ?? '12 giờ' }}</span>
        </div>
        <div class="fw-bold text-primary">
            {{ number_format($course['price'], 0, ',', '.') }} ₫
        </div>
    </div>
    <a href="{{ route('courses.show', $course['id']) }}" class="stretched-link"></a>
</div>
