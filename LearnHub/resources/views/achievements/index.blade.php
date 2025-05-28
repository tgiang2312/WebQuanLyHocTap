@extends('layouts.app')

@section('title', 'Thành tích - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0">Thành tích</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-2"></i> Quay lại bảng điều khiển
        </a>
    </div>
    
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <h4 class="fw-semibold mb-0">Thành tích của tôi</h4>
                </div>
                
                <div class="card-body">
                    @if(count($achievements) > 0)
                        <div class="row g-4">
                            @foreach($achievements as $achievement)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center p-4">
                                            <div class="display-4 mb-3">{{ $achievement['icon'] }}</div>
                                            <h5 class="fw-semibold mb-2">{{ $achievement['title'] }}</h5>
                                            <p class="text-muted mb-0">
                                                Đạt được vào {{ \Carbon\Carbon::parse($achievement['date'])->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-trophy text-warning" style="font-size: 4rem;"></i>
                            <h3 class="mt-3">Chưa có thành tích nào</h3>
                            <p class="text-muted">Hãy tiếp tục học tập để đạt được các thành tích!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-12 mt-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <h4 class="fw-semibold mb-0">Thành tích có thể đạt được</h4>
                </div>
                
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm opacity-75">
                                <div class="card-body text-center p-4">
                                    <div class="display-4 mb-3">🎓</div>
                                    <h5 class="fw-semibold mb-2">Hoàn thành 5 khóa học</h5>
                                    <p class="text-muted mb-0">
                                        Tiến độ: 1/5 khóa học
                                    </p>
                                    <div class="progress mt-3" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" 
                                             style="width: 20%" 
                                             aria-valuenow="20" 
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm opacity-75">
                                <div class="card-body text-center p-4">
                                    <div class="display-4 mb-3">📝</div>
                                    <h5 class="fw-semibold mb-2">Nộp 10 bài tập đúng hạn</h5>
                                    <p class="text-muted mb-0">
                                        Tiến độ: 5/10 bài tập
                                    </p>
                                    <div class="progress mt-3" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" 
                                             style="width: 50%" 
                                             aria-valuenow="50" 
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm opacity-75">
                                <div class="card-body text-center p-4">
                                    <div class="display-4 mb-3">⭐</div>
                                    <h5 class="fw-semibold mb-2">Đạt điểm tuyệt đối 5 bài tập</h5>
                                    <p class="text-muted mb-0">
                                        Tiến độ: 2/5 bài tập
                                    </p>
                                    <div class="progress mt-3" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" 
                                             style="width: 40%" 
                                             aria-valuenow="40" 
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 