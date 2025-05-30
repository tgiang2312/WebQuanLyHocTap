<div class="card h-100 border-0 shadow-sm course-card">
    <div class="position-relative">
        <img src="{{ isset($course['imageUrl']) ? $course['imageUrl'] : ($course['image'] ?? asset('images/placeholder.jpg')) }}" 
             alt="{{ $course['title'] }}" class="card-img-top">
        <div class="course-status">
            <span class="badge bg-primary">{{ $course['category'] }}</span>
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-2">{{ $course['title'] }}</h5>
        <div class="instructor-info">
            <span class="instructor-name">{{ $course['instructor'] }}</span>
        </div>
        <div class="d-flex align-items-center mb-2">
            <i class="bi bi-star-fill text-warning me-1"></i>
            <span class="fw-medium me-1">{{ $course['rating'] }}</span>
            <span class="text-muted">({{ $course['students'] }})</span>
        </div>
    </div>
    <div class="card-footer bg-white border-top">
        <div class="course-meta">
            <div class="meta-item">
                <i class="bi bi-clock meta-icon"></i>
                <span>{{ $course['duration'] ?? '12 giờ' }}</span>
            </div>
            <div class="fw-bold text-primary">
                {{ number_format($course['price'], 0, ',', '.') }} ₫
            </div>
        </div>
    </div>
    <a href="{{ route('courses.show', $course['id']) }}" class="stretched-link"></a>
</div>
