@extends('layouts.app')

@section('title', 'Quản lý bài tập - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Quản lý bài tập</h1>
        <a href="{{ route('teachers.assignments.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tạo bài tập mới
        </a>
    </div>
    
    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('teachers.assignments') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="course" class="form-label">Khóa học</label>
                    <select id="course" name="course" class="form-select">
                        <option value="">Tất cả khóa học</option>
                        <!-- Đoạn này sẽ được điền bằng dữ liệu thực tế sau -->
                        <option value="1">Lập trình PHP cơ bản</option>
                        <option value="2">JavaScript nâng cao</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="active">Đang mở</option>
                        <option value="past">Đã hết hạn</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-filter me-2"></i> Lọc
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Assignments List -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 ps-4">Bài tập</th>
                            <th class="py-3">Khóa học</th>
                            <th class="py-3">Thời hạn</th>
                            <th class="py-3">Bài nộp</th>
                            <th class="py-3 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $assignment)
                            <tr>
                                <td class="ps-4">
                                    <h6 class="fw-semibold mb-1">{{ $assignment->title }}</h6>
                                    <p class="text-muted mb-0 small">{{ Str::limit($assignment->description, 50) }}</p>
                                </td>
                                <td>{{ $assignment->course->title }}</td>
                                <td>
                                    <span class="{{ $assignment->due_date < now() ? 'text-danger' : 'text-success' }}">
                                        {{ $assignment->due_date->format('d/m/Y H:i') }}
                                    </span>
                                    @if($assignment->due_date < now())
                                        <span class="badge bg-danger">Đã hết hạn</span>
                                    @else
                                        <span class="badge bg-success">Đang mở</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('assignments.submissions', $assignment) }}" class="text-decoration-none">
                                        {{ $assignment->submissions->count() }} bài nộp
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="{{ route('assignments.show', $assignment) }}">Xem chi tiết</a></li>
                                            <li><a class="dropdown-item" href="{{ route('assignments.edit', $assignment) }}">Chỉnh sửa</a></li>
                                            <li>
                                                <form action="{{ route('assignments.destroy', $assignment) }}" method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài tập này?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">Xóa</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <p class="text-muted mb-0">Chưa có bài tập nào</p>
                                    <a href="{{ route('teachers.assignments.create') }}" class="btn btn-primary mt-3">
                                        <i class="bi bi-plus-circle me-2"></i> Tạo bài tập mới
                                    </a>
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