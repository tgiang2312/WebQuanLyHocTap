@extends('layouts.app')

@section('title', 'Chỉnh sửa khóa học - ' . $course->title)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">Chỉnh sửa khóa học</h2>
                        <div>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary me-2">
                                <i class="bi bi-arrow-left me-2"></i> Quay lại khóa học
                            </a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa khóa học này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="bi bi-trash me-2"></i> Xóa khóa học
                                </button>
                            </form>
                        </div>
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
                    
                    <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Tên khóa học <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $course->title) }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="category" class="form-label fw-semibold">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled>Chọn danh mục</option>
                                <option value="web" {{ old('category', $course->category) == 'web' ? 'selected' : '' }}>Lập trình Web</option>
                                <option value="mobile" {{ old('category', $course->category) == 'mobile' ? 'selected' : '' }}>Lập trình Di động</option>
                                <option value="database" {{ old('category', $course->category) == 'database' ? 'selected' : '' }}>Cơ sở dữ liệu</option>
                                <option value="design" {{ old('category', $course->category) == 'design' ? 'selected' : '' }}>Thiết kế UI/UX</option>
                                <option value="ai" {{ old('category', $course->category) == 'ai' ? 'selected' : '' }}>Trí tuệ nhân tạo</option>
                                <option value="network" {{ old('category', $course->category) == 'network' ? 'selected' : '' }}>Mạng máy tính</option>
                                <option value="security" {{ old('category', $course->category) == 'security' ? 'selected' : '' }}>Bảo mật</option>
                                <option value="other" {{ old('category', $course->category) == 'other' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="level" class="form-label fw-semibold">Cấp độ <span class="text-danger">*</span></label>
                            <select class="form-select" id="level" name="level" required>
                                <option value="" disabled>Chọn cấp độ</option>
                                <option value="beginner" {{ old('level', $course->level) == 'beginner' ? 'selected' : '' }}>Cơ bản</option>
                                <option value="intermediate" {{ old('level', $course->level) == 'intermediate' ? 'selected' : '' }}>Trung cấp</option>
                                <option value="advanced" {{ old('level', $course->level) == 'advanced' ? 'selected' : '' }}>Nâng cao</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Mô tả khóa học <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="6" required>{{ old('description', $course->description) }}</textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Ảnh đại diện khóa học</label>
                            @if($course->image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" 
                                         class="img-thumbnail" style="max-height: 200px;">
                                    <div class="form-text">Ảnh hiện tại. Tải lên ảnh mới để thay thế.</div>
                                </div>
                            @endif
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                            <div class="form-text">Kích thước tối đa: 2MB. Định dạng: JPG, PNG, GIF</div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sessions" class="form-label fw-semibold">Số buổi học</label>
                                    <input type="number" class="form-control" id="sessions" name="sessions" 
                                           value="{{ old('sessions', $course->sessions) }}" min="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label fw-semibold">Học phí (VND)</label>
                                    <input type="number" class="form-control" id="price" name="price" 
                                           value="{{ old('price', $course->price) }}" min="0">
                                    <div class="form-text">Để 0 nếu khóa học miễn phí</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="status" class="form-label fw-semibold">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                                <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : '' }}>Xuất bản</option>
                            </select>
                            <div class="form-text">
                                Bản nháp: Khóa học chỉ hiển thị với bạn và quản trị viên<br>
                                Xuất bản: Khóa học hiển thị với tất cả người dùng
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary">Hủy</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i> Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 