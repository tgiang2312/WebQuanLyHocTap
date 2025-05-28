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
                                @switch($activity->activity_type)
                                    @case('enrollment')
                                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle">
                                            <i class="bi bi-person-plus fs-5 text-primary"></i>
                                        </div>
                                        @break
                                    @case('completion')
                                        <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                                            <i class="bi bi-check-circle fs-5 text-success"></i>
                                        </div>
                                        @break
                                    @case('submission')
                                        <div class="bg-info bg-opacity-10 p-2 rounded-circle">
                                            <i class="bi bi-file-earmark-text fs-5 text-info"></i>
                                        </div>
                                        @break
                                    @case('comment')
                                        <div class="bg-warning bg-opacity-10 p-2 rounded-circle">
                                            <i class="bi bi-chat-left-text fs-5 text-warning"></i>
                                        </div>
                                        @break
                                    @default
                                        <div class="bg-secondary bg-opacity-10 p-2 rounded-circle">
                                            <i class="bi bi-clock-history fs-5 text-secondary"></i>
                                        </div>
                                @endswitch
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-semibold">{{ $activity->user_name }}</h6>
                                    <span class="text-muted small">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</span>
                                </div>
                                <p class="mb-0">
                                    @switch($activity->activity_type)
                                        @case('enrollment')
                                            Đã đăng ký khóa học <strong>{{ $activity->course_title }}</strong>
                                            @break
                                        @case('completion')
                                            Đã hoàn thành khóa học <strong>{{ $activity->course_title }}</strong>
                                            @break
                                        @case('submission')
                                            Đã nộp bài tập trong khóa học <strong>{{ $activity->course_title }}</strong>
                                            @break
                                        @case('comment')
                                            Đã bình luận trong khóa học <strong>{{ $activity->course_title }}</strong>
                                            @break
                                        @default
                                            Đã tương tác với khóa học <strong>{{ $activity->course_title }}</strong>
                                    @endswitch
                                </p>
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