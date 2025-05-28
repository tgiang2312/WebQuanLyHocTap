@extends('layouts.app')

@section('title', 'Nộp bài tập - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h2 class="fw-bold mb-0">Nộp bài tập</h2>
                        <a href="{{ route('assignments.show', $assignment['id'] ?? 1) }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i> Quay lại bài tập
                        </a>
                    </div>
                    <div class="d-flex align-items-center text-muted">
                        <span class="me-3">
                            <i class="bi bi-file-text me-1"></i> Bài tập: {{ $assignment['title'] ?? 'Tên bài tập' }}
                        </span>
                        <span>
                            <i class="bi bi-calendar me-1"></i> Hạn nộp: 
                            {{ isset($assignment['dueDate']) ? \Carbon\Carbon::parse($assignment['dueDate'])->format('d/m/Y H:i') : 'Chưa có hạn' }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('submissions.store', $assignment['id'] ?? 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="content" class="form-label fw-semibold">Nội dung bài nộp</label>
                            <textarea class="form-control" id="content" name="content" rows="6" placeholder="Nhập nội dung, mô tả, ghi chú về bài nộp của bạn..."></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="files" class="form-label fw-semibold">Tệp đính kèm</label>
                            <input class="form-control" type="file" id="files" name="files[]" multiple>
                            <div class="form-text">Bạn có thể đính kèm nhiều tệp. Kích thước tối đa cho mỗi tệp là 10MB.</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="url" class="form-label fw-semibold">Liên kết (tuỳ chọn)</label>
                            <input type="url" class="form-control" id="url" name="url" placeholder="https://example.com/your-project">
                            <div class="form-text">Nếu bạn đã triển khai dự án online, hãy cung cấp liên kết.</div>
                        </div>
                        
                        <div class="alert alert-info mb-4">
                            <div class="d-flex">
                                <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                                <div>
                                    <h5 class="fw-semibold">Lưu ý khi nộp bài:</h5>
                                    <ul class="mb-0">
                                        <li>Đảm bảo bạn đã hoàn thành tất cả các yêu cầu của bài tập</li>
                                        <li>Kiểm tra kỹ tệp đính kèm trước khi nộp</li>
                                        <li>Sau khi nộp, bạn vẫn có thể chỉnh sửa bài nộp cho đến khi hết hạn</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-cloud-upload me-2"></i> Nộp bài
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 