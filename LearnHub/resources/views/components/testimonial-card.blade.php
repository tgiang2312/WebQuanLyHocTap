<div class="card border-0 shadow-sm h-100 testimonial-card">
    <div class="card-body p-4">
        <div class="d-flex align-items-center mb-3">
            <img src="{{ $testimonial['avatar'] ?? asset('images/avatar-placeholder.jpg') }}" 
                 alt="{{ $testimonial['name'] }}" class="rounded-circle me-3" 
                 style="width: 60px; height: 60px; object-fit: cover;">
            <div>
                <h5 class="fw-semibold mb-0">{{ $testimonial['name'] }}</h5>
                <p class="text-muted small mb-0">{{ $testimonial['role'] }}</p>
            </div>
        </div>
        
        <div class="mb-3">
            @for ($i = 1; $i <= 5; $i++)
                <i class="bi bi-star{{ $i <= $testimonial['rating'] ? '-fill' : '' }} text-warning"></i>
            @endfor
        </div>
        
        <p class="text-muted fst-italic">
            "{{ $testimonial['content'] }}"
        </p>
    </div>
</div>
