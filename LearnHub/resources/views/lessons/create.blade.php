@extends('layouts.app')

@section('title', 'Tạo bài học mới - ' . $course->title)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">Tạo bài học mới</h2>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i> Quay lại khóa học
                        </a>
                    </div>
                    <p class="text-muted mt-2 mb-0">Khóa học: {{ $course->title }}</p>
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
                    
                    <form action="{{ route('lessons.store', $course) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Tiêu đề bài học <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="content" class="form-label fw-semibold">Nội dung bài học <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="12" required>{{ old('content') }}</textarea>
                            <div class="form-text">Bạn có thể sử dụng Markdown để định dạng nội dung.</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="video_url" class="form-label fw-semibold">Đường dẫn video (nếu có)</label>
                            <input type="url" class="form-control" id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=...">
                            <div class="form-text">Hỗ trợ YouTube, Vimeo hoặc các dịch vụ video khác.</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="order" class="form-label fw-semibold">Thứ tự bài học</label>
                            <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $course->lessons->count() + 1) }}" min="1">
                            <div class="form-text">Thứ tự hiển thị của bài học trong khóa học.</div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Tài liệu đính kèm</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="files" name="files[]" multiple>
                                <button class="btn btn-outline-secondary" type="button" id="addMoreFiles">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            <div id="fileList" class="list-group mt-2"></div>
                            <div class="form-text">Kích thước tối đa: 10MB mỗi tệp. Hỗ trợ các định dạng: PDF, DOC, DOCX, PPT, PPTX, ZIP, RAR, v.v.</div>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary">Hủy</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i> Lưu bài học
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
        // Hiển thị tên file đã chọn
        document.getElementById('files').addEventListener('change', updateFileList);
        
        // Thêm nút để thêm nhiều file
        document.getElementById('addMoreFiles').addEventListener('click', function() {
            document.getElementById('files').click();
        });
    });
    
    function updateFileList(event) {
        const fileList = document.getElementById('fileList');
        const files = event.target.files;
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const fileSize = (file.size / 1024).toFixed(2);
            
            const listItem = document.createElement('div');
            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            listItem.innerHTML = `
                <div>
                    <i class="bi bi-file-earmark me-2"></i>
                    <span>${file.name}</span>
                    <span class="text-muted ms-2">(${fileSize} KB)</span>
                </div>
            `;
            
            fileList.appendChild(listItem);
        }
    }
</script>
@endsection 