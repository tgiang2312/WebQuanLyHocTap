@extends('layouts.app')

@section('title', 'Tạo bài tập mới - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">Tạo bài tập mới</h2>
                        <a href="{{ route('teachers.assignments') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('teachers.assignments.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Tiêu đề bài tập <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="course_id" class="form-label fw-semibold">Khóa học <span class="text-danger">*</span></label>
                            <select class="form-select" id="course_id" name="course_id" required>
                                <option value="" selected disabled>Chọn khóa học</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Mô tả bài tập <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="6" required>{{ old('description') }}</textarea>
                            <div class="form-text">Mô tả chi tiết yêu cầu bài tập</div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="due_date" class="form-label fw-semibold">Thời hạn nộp bài <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_score" class="form-label fw-semibold">Điểm tối đa <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="max_score" name="max_score" value="{{ old('max_score', 10) }}" min="0" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mb-4">
                            <div class="d-flex">
                                <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                                <div>
                                    <h5 class="fw-semibold">Lưu ý khi tạo bài tập:</h5>
                                    <ul class="mb-0">
                                        <li>Bài tập sẽ được gửi cho tất cả học viên đã đăng ký khóa học</li>
                                        <li>Học viên có thể nộp bài tập sau thời hạn, nhưng sẽ được đánh dấu là nộp muộn</li>
                                        <li>Bạn có thể chỉnh sửa thông tin bài tập bất cứ lúc nào</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('teachers.assignments') }}" class="btn btn-secondary">Hủy</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i> Tạo bài tập
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 