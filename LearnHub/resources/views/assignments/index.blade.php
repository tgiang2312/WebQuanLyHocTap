@extends('layouts.app')

@section('title', 'Bài tập - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0">Bài tập</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-2"></i> Quay lại bảng điều khiển
        </a>
    </div>
    
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="fw-semibold mb-0">Tất cả bài tập</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-3 justify-content-md-end mt-3 mt-md-0">
                                <select class="form-select w-auto">
                                    <option value="all">Tất cả trạng thái</option>
                                    <option value="pending">Chưa nộp</option>
                                    <option value="submitted">Đã nộp</option>
                                    <option value="graded">Đã chấm điểm</option>
                                </select>
                                <select class="form-select w-auto">
                                    <option value="all">Sắp xếp theo</option>
                                    <option value="duedate">Hạn nộp</option>
                                    <option value="course">Khóa học</option>
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
                                    <th class="py-3 ps-4">Bài tập</th>
                                    <th class="py-3">Khóa học</th>
                                    <th class="py-3">Hạn nộp</th>
                                    <th class="py-3">Trạng thái</th>
                                    <th class="py-3 text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($assignments as $assignment)
                                    <tr>
                                        <td class="ps-4">
                                            <h6 class="fw-semibold mb-0">{{ $assignment['title'] }}</h6>
                                        </td>
                                        <td>{{ $assignment['course'] }}</td>
                                        <td>
                                            <span class="{{ \Carbon\Carbon::parse($assignment['dueDate'])->isPast() ? 'text-danger' : 'text-muted' }}">
                                                {{ \Carbon\Carbon::parse($assignment['dueDate'])->format('d/m/Y H:i') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning text-dark">Chưa nộp</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('assignments.show', $assignment['id']) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="bi bi-eye me-1"></i> Xem
                                                </a>
                                                <a href="{{ route('submissions.create', $assignment['id']) }}" 
                                                   class="btn btn-sm btn-success">
                                                    <i class="bi bi-upload"></i> Nộp bài
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <p class="text-muted mb-0">Không có bài tập nào</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 