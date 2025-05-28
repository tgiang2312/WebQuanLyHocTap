@extends('layouts.app')

@section('title', 'Chi tiết bài tập - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h2 class="fw-bold mb-0">Bài tập: {{ $assignment['title'] ?? 'Chi tiết bài tập' }}</h2>
                        <a href="{{ route('assignments.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i> Quay lại danh sách
                        </a>
                    </div>
                    <div class="d-flex align-items-center text-muted">
                        <span class="me-3">
                            <i class="bi bi-book me-1"></i> Khóa học: {{ $assignment['course'] ?? 'Tên khóa học' }}
                        </span>
                        <span>
                            <i class="bi bi-calendar me-1"></i> Hạn nộp: 
                            {{ isset($assignment['dueDate']) ? \Carbon\Carbon::parse($assignment['dueDate'])->format('d/m/Y H:i') : 'Chưa có hạn' }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3">Mô tả bài tập</h5>
                        <div class="p-3 bg-light rounded">
                            <p>Đây là phần mô tả chi tiết của bài tập. Trong bài tập này, bạn cần hoàn thành các yêu cầu sau:</p>
                            
                            <ul>
                                <li>Xây dựng giao diện người dùng theo thiết kế đã cho</li>
                                <li>Triển khai các chức năng cơ bản như đăng nhập, đăng ký</li>
                                <li>Đảm bảo trang web hoạt động tốt trên các thiết bị di động</li>
                            </ul>
                            
                            <p>Hãy làm việc cẩn thận và nộp bài đúng hạn!</p>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3">Tài liệu đính kèm</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                    <span>Hướng dẫn chi tiết.pdf</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-download"></i> Tải xuống
                                </a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-file-earmark-zip text-warning me-2"></i>
                                    <span>Mã nguồn mẫu.zip</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-download"></i> Tải xuống
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3">Trạng thái nộp bài</h5>
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Bạn chưa nộp bài tập này. Hạn nộp còn 3 ngày.
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <a href="{{ route('submissions.create', $assignment['id'] ?? 1) }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-upload me-2"></i> Nộp bài tập
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 