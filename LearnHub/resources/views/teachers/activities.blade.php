@extends('layouts.app')

@section('title', 'Hoạt động gần đây - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Hoạt động gần đây</h1>
    </div>
    
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white p-4 border-0">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h4 class="fw-semibold mb-0">Lịch sử hoạt động</h4>
                    <p class="text-muted mb-md-0">Danh sách các hoạt động liên quan đến khóa học của bạn</p>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('teachers.activities') }}" method="GET" class="d-flex gap-2 justify-content-md-end">
                        <select name="type" class="form-select w-auto">
                            <option value="">Tất cả hoạt động</option>
                            <option value="enrollment">Đăng ký khóa học</option>
                            <option value="completion">Hoàn thành khóa học</option>
                            <option value="submission">Nộp bài tập</option>
                            <option value="comment">Bình luận</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Lọc</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @forelse($activities as $activity)
                    <div class="list-group-item py-3 px-4">
                        <div class="d-flex align-items-center">
                            <div class="activity-icon me-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-circle">
                                    <i class="bi {{ $activity->icon }} fs-5 text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-semibold">{{ $activity->user->name ?? 'Người dùng' }}</h6>
                                    <span class="text-muted small">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</span>
                                </div>
                                <p class="mb-0">
                                    {{ $activity->title }}
                                    @if($activity->course)
                                    <strong>{{ $activity->course->title }}</strong>
                                    @endif
                                </p>
                                @if($activity->description)
                                <p class="text-muted small mb-0">{{ $activity->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-clock-history fs-1 text-muted"></i>
                        </div>
                        <h5 class="fw-semibold">Chưa có hoạt động nào</h5>
                        <p class="text-muted">Các hoạt động của học viên liên quan đến khóa học của bạn sẽ hiển thị ở đây.</p>
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Pagination -->
        @if($activities->hasPages())
            <div class="card-footer bg-white py-3">
                <div class="d-flex justify-content-center">
                    {{ $activities->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 