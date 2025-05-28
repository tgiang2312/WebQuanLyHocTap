@extends('layouts.app')

@section('title', 'Tạo khóa học mới - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">Tạo khóa học mới</h2>
                        <a href="{{ route('courses.index') }}" class="btn btn-outline-primary">
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
                    
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Tên khóa học <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            <div class="form-text">Đặt tên ngắn gọn và hấp dẫn cho khóa học của bạn</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="category" class="form-label fw-semibold">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" selected disabled>Chọn danh mục</option>
                                <option value="web" {{ old('category') == 'web' ? 'selected' : '' }}>Lập trình Web</option>
                                <option value="mobile" {{ old('category') == 'mobile' ? 'selected' : '' }}>Lập trình Di động</option>
                                <option value="database" {{ old('category') == 'database' ? 'selected' : '' }}>Cơ sở dữ liệu</option>
                                <option value="design" {{ old('category') == 'design' ? 'selected' : '' }}>Thiết kế UI/UX</option>
                                <option value="ai" {{ old('category') == 'ai' ? 'selected' : '' }}>Trí tuệ nhân tạo</option>
                                <option value="network" {{ old('category') == 'network' ? 'selected' : '' }}>Mạng máy tính</option>
                                <option value="security" {{ old('category') == 'security' ? 'selected' : '' }}>Bảo mật</option>
                                <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="level" class="form-label fw-semibold">Cấp độ <span class="text-danger">*</span></label>
                            <select class="form-select" id="level" name="level" required>
                                <option value="" selected disabled>Chọn cấp độ</option>
                                <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>Cơ bản</option>
                                <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>Trung cấp</option>
                                <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>Nâng cao</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Mô tả khóa học <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="6" required>{{ old('description') }}</textarea>
                            <div class="form-text">Mô tả chi tiết về nội dung, mục tiêu và đối tượng học viên của khóa học</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold">Ảnh đại diện khóa học</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                            <div class="form-text">Kích thước tối đa: 2MB. Định dạng: JPG, PNG, GIF</div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sessions" class="form-label fw-semibold">Số buổi học</label>
                                    <input type="number" class="form-control" id="sessions" name="sessions" value="{{ old('sessions') }}" min="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label fw-semibold">Học phí (VND)</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', 0) }}" min="0">
                                    <div class="form-text">Để 0 nếu khóa học miễn phí</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mb-4">
                            <div class="d-flex">
                                <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                                <div>
                                    <h5 class="fw-semibold">Lưu ý khi tạo khóa học:</h5>
                                    <ul class="mb-0">
                                        <li>Sau khi tạo khóa học, bạn có thể thêm các bài học vào khóa học</li>
                                        <li>Khóa học sẽ không được hiển thị với học viên cho đến khi có bài học</li>
                                        <li>Bạn có thể chỉnh sửa thông tin khóa học bất cứ lúc nào</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i> Tạo khóa học
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 