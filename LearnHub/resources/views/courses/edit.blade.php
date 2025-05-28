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
                                <option value="Lập trình" {{ old('category', $course->category) == 'Lập trình' ? 'selected' : '' }}>Lập trình</option>
                                <option value="Marketing" {{ old('category', $course->category) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="Thiết kế" {{ old('category', $course->category) == 'Thiết kế' ? 'selected' : '' }}>Thiết kế</option>
                                <option value="Kinh doanh" {{ old('category', $course->category) == 'Kinh doanh' ? 'selected' : '' }}>Kinh doanh</option>
                                <option value="Ngoại ngữ" {{ old('category', $course->category) == 'Ngoại ngữ' ? 'selected' : '' }}>Ngoại ngữ</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="subcategory" class="form-label fw-semibold">Danh mục con <span class="text-danger">*</span></label>
                            <select class="form-select" id="subcategory" name="subcategory" required>
                                <option value="" selected disabled>Chọn danh mục con</option>
                                <!-- Lập trình -->
                                <optgroup label="Lập trình" class="subcategory-group" data-category="Lập trình">
                                    <option value="Lập trình Web" data-category="Lập trình" {{ old('subcategory', $course->subcategory) == 'Lập trình Web' ? 'selected' : '' }}>Lập trình Web</option>
                                    <option value="Lập trình Mobile" data-category="Lập trình" {{ old('subcategory', $course->subcategory) == 'Lập trình Mobile' ? 'selected' : '' }}>Lập trình Mobile</option>
                                    <option value="Trí tuệ nhân tạo" data-category="Lập trình" {{ old('subcategory', $course->subcategory) == 'Trí tuệ nhân tạo' ? 'selected' : '' }}>Trí tuệ nhân tạo</option>
                                    <option value="Cơ sở dữ liệu" data-category="Lập trình" {{ old('subcategory', $course->subcategory) == 'Cơ sở dữ liệu' ? 'selected' : '' }}>Cơ sở dữ liệu</option>
                                    <option value="Bảo mật" data-category="Lập trình" {{ old('subcategory', $course->subcategory) == 'Bảo mật' ? 'selected' : '' }}>Bảo mật</option>
                                </optgroup>
                                
                                <!-- Marketing -->
                                <optgroup label="Marketing" class="subcategory-group" data-category="Marketing">
                                    <option value="Digital Marketing" data-category="Marketing" {{ old('subcategory', $course->subcategory) == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                                    <option value="Social Media Marketing" data-category="Marketing" {{ old('subcategory', $course->subcategory) == 'Social Media Marketing' ? 'selected' : '' }}>Social Media Marketing</option>
                                    <option value="Content Marketing" data-category="Marketing" {{ old('subcategory', $course->subcategory) == 'Content Marketing' ? 'selected' : '' }}>Content Marketing</option>
                                    <option value="SEO" data-category="Marketing" {{ old('subcategory', $course->subcategory) == 'SEO' ? 'selected' : '' }}>SEO</option>
                                    <option value="Email Marketing" data-category="Marketing" {{ old('subcategory', $course->subcategory) == 'Email Marketing' ? 'selected' : '' }}>Email Marketing</option>
                                </optgroup>
                                
                                <!-- Thiết kế -->
                                <optgroup label="Thiết kế" class="subcategory-group" data-category="Thiết kế">
                                    <option value="UI/UX Design" data-category="Thiết kế" {{ old('subcategory', $course->subcategory) == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                                    <option value="Thiết kế đồ họa" data-category="Thiết kế" {{ old('subcategory', $course->subcategory) == 'Thiết kế đồ họa' ? 'selected' : '' }}>Thiết kế đồ họa</option>
                                    <option value="Thiết kế Web" data-category="Thiết kế" {{ old('subcategory', $course->subcategory) == 'Thiết kế Web' ? 'selected' : '' }}>Thiết kế Web</option>
                                    <option value="Thiết kế 3D" data-category="Thiết kế" {{ old('subcategory', $course->subcategory) == 'Thiết kế 3D' ? 'selected' : '' }}>Thiết kế 3D</option>
                                    <option value="Animation" data-category="Thiết kế" {{ old('subcategory', $course->subcategory) == 'Animation' ? 'selected' : '' }}>Animation</option>
                                </optgroup>
                                
                                <!-- Kinh doanh -->
                                <optgroup label="Kinh doanh" class="subcategory-group" data-category="Kinh doanh">
                                    <option value="Khởi nghiệp" data-category="Kinh doanh" {{ old('subcategory', $course->subcategory) == 'Khởi nghiệp' ? 'selected' : '' }}>Khởi nghiệp</option>
                                    <option value="Tài chính" data-category="Kinh doanh" {{ old('subcategory', $course->subcategory) == 'Tài chính' ? 'selected' : '' }}>Tài chính</option>
                                    <option value="Quản lý" data-category="Kinh doanh" {{ old('subcategory', $course->subcategory) == 'Quản lý' ? 'selected' : '' }}>Quản lý</option>
                                    <option value="Bán hàng" data-category="Kinh doanh" {{ old('subcategory', $course->subcategory) == 'Bán hàng' ? 'selected' : '' }}>Bán hàng</option>
                                    <option value="Thương mại điện tử" data-category="Kinh doanh" {{ old('subcategory', $course->subcategory) == 'Thương mại điện tử' ? 'selected' : '' }}>Thương mại điện tử</option>
                                </optgroup>
                                
                                <!-- Ngoại ngữ -->
                                <optgroup label="Ngoại ngữ" class="subcategory-group" data-category="Ngoại ngữ">
                                    <option value="Tiếng Anh" data-category="Ngoại ngữ" {{ old('subcategory', $course->subcategory) == 'Tiếng Anh' ? 'selected' : '' }}>Tiếng Anh</option>
                                    <option value="Tiếng Nhật" data-category="Ngoại ngữ" {{ old('subcategory', $course->subcategory) == 'Tiếng Nhật' ? 'selected' : '' }}>Tiếng Nhật</option>
                                    <option value="Tiếng Hàn" data-category="Ngoại ngữ" {{ old('subcategory', $course->subcategory) == 'Tiếng Hàn' ? 'selected' : '' }}>Tiếng Hàn</option>
                                    <option value="Tiếng Trung" data-category="Ngoại ngữ" {{ old('subcategory', $course->subcategory) == 'Tiếng Trung' ? 'selected' : '' }}>Tiếng Trung</option>
                                    <option value="Tiếng Pháp" data-category="Ngoại ngữ" {{ old('subcategory', $course->subcategory) == 'Tiếng Pháp' ? 'selected' : '' }}>Tiếng Pháp</option>
                                </optgroup>
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
                                    <label for="price" class="form-label fw-semibold">Học phí (VND) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="price" name="price" 
                                           value="{{ old('price', $course->price) }}" min="0" required>
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const subcategorySelect = document.getElementById('subcategory');
        const subcategoryGroups = document.querySelectorAll('.subcategory-group');
        
        // Hàm để hiển thị các danh mục con phù hợp
        function updateSubcategories() {
            const selectedCategory = categorySelect.value;
            
            // Ẩn tất cả các nhóm danh mục con
            subcategoryGroups.forEach(group => {
                const options = group.querySelectorAll('option');
                options.forEach(option => {
                    option.style.display = 'none';
                });
                group.style.display = 'none';
            });
            
            // Hiển thị nhóm danh mục con phù hợp
            if (selectedCategory) {
                const matchingGroup = document.querySelector(`.subcategory-group[data-category="${selectedCategory}"]`);
                if (matchingGroup) {
                    matchingGroup.style.display = '';
                    const options = matchingGroup.querySelectorAll('option');
                    options.forEach(option => {
                        option.style.display = '';
                    });
                }
            }
        }
        
        // Gọi hàm khi trang được tải
        updateSubcategories();
        
        // Gọi hàm khi danh mục thay đổi
        categorySelect.addEventListener('change', updateSubcategories);
    });
</script>
@endsection 