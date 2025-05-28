@extends('layouts.app')

@section('title', 'Bài tập của tôi - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Bài tập của tôi</h1>
    </div>
    
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('students.assignments') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tìm kiếm bài tập..." name="search" value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-md-end mt-3 mt-md-0">
                        <select class="form-select w-auto" name="status" onchange="this.form.submit()">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chưa nộp</option>
                            <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Đã nộp</option>
                            <option value="graded" {{ request('status') == 'graded' ? 'selected' : '' }}>Đã chấm điểm</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-4">Bài tập</th>
                            <th class="py-3">Khóa học</th>
                            <th class="py-3">Hạn nộp</th>
                            <th class="py-3">Trạng thái</th>
                            <th class="py-3 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $assignment)
                            <tr>
                                <td class="py-3 px-4">
                                    <div class="fw-medium">{{ $assignment->title }}</div>
                                    <div class="text-muted small">{{ Str::limit($assignment->description, 60) }}</div>
                                </td>
                                <td class="py-3">
                                    <a href="{{ route('courses.show', $assignment->lesson->course->id) }}" class="text-decoration-none">
                                        {{ $assignment->lesson->course->title }}
                                    </a>
                                </td>
                                <td class="py-3">
                                    @if($assignment->due_date)
                                        @if($assignment->due_date->isPast())
                                            <span class="text-danger">{{ $assignment->due_date->format('d/m/Y H:i') }}</span>
                                        @else
                                            {{ $assignment->due_date->format('d/m/Y H:i') }}
                                        @endif
                                    @else
                                        <span class="text-muted">Không có hạn</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    @php
                                        $submission = $assignment->submissions->where('user_id', Auth::id())->first();
                                        $status = !$submission ? 'pending' : ($submission->grade ? 'graded' : 'submitted');
                                    @endphp
                                    
                                    @if($status == 'pending')
                                        <span class="badge bg-warning">Chưa nộp</span>
                                    @elseif($status == 'submitted')
                                        <span class="badge bg-info">Đã nộp</span>
                                    @else
                                        <span class="badge bg-success">Đã chấm điểm</span>
                                    @endif
                                </td>
                                <td class="py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Xem
                                        </a>
                                        
                                        @if($status == 'pending' || $status == 'submitted')
                                            <a href="{{ route('submissions.create', $assignment->id) }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-upload"></i> Nộp bài
                                            </a>
                                        @endif
                                        
                                        @if($status == 'graded')
                                            <a href="{{ route('submissions.show', $submission->id) }}" class="btn btn-sm btn-success">
                                                <i class="bi bi-check-circle"></i> Xem điểm
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-file-earmark-text fs-1 d-block mb-3"></i>
                                        <p>Không có bài tập nào</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 