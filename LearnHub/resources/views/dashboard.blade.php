@extends('layouts.app')

@section('title', 'Bảng điều khiển - LearnHub')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm scale-in show">
                <div class="card-body p-5">
                    <h1 class="fw-bold mb-4 typing-text">Chào mừng đến với LearnHub</h1>
                    
                    @if(Auth::user()->role === 'admin')
                        <div class="mb-4 animate-on-scroll">
                            <div class="bg-danger bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3 pulse">
                                <i class="bi bi-shield-check fs-1 text-danger"></i>
                            </div>
                            <h2 class="fs-4 fw-bold">Quản trị viên</h2>
                            <p class="text-muted">Bạn có quyền truy cập đầy đủ vào hệ thống</p>
                        </div>
                        
                        <div class="d-grid gap-2 stagger-container">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-danger btn-animated">
                                <i class="bi bi-gear me-2"></i> Quản trị hệ thống
                            </a>
                            <a href="{{ route('teachers.dashboard') }}" class="btn btn-primary btn-animated">
                                <i class="bi bi-person-workspace me-2"></i> Bảng điều khiển giảng viên
                            </a>
                            <a href="{{ route('students.dashboard') }}" class="btn btn-success btn-animated">
                                <i class="bi bi-person-badge me-2"></i> Bảng điều khiển học viên
                            </a>
                        </div>
                    @elseif(Auth::user()->role === 'teacher')
                        <div class="mb-4 animate-on-scroll">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3 pulse">
                                <i class="bi bi-person-workspace fs-1 text-primary"></i>
                            </div>
                            <h2 class="fs-4 fw-bold">Giảng viên</h2>
                            <p class="text-muted">Bạn có thể quản lý các khóa học và học viên của mình</p>
                        </div>
                        
                        <div class="d-grid gap-2 stagger-container">
                            <a href="{{ route('teachers.dashboard') }}" class="btn btn-primary btn-animated">
                                <i class="bi bi-speedometer2 me-2"></i> Bảng điều khiển giảng viên
                            </a>
                            <a href="{{ route('courses.create') }}" class="btn btn-outline-primary btn-animated">
                                <i class="bi bi-plus-circle me-2"></i> Tạo khóa học mới
                            </a>
                        </div>
                    @else
                        <div class="mb-4 animate-on-scroll">
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3 pulse">
                                <i class="bi bi-person-badge fs-1 text-success"></i>
                            </div>
                            <h2 class="fs-4 fw-bold">Học viên</h2>
                            <p class="text-muted">Bạn có thể học và theo dõi tiến độ của mình</p>
                        </div>
                        
                        <div class="d-grid gap-2 stagger-container">
                            <a href="{{ route('students.dashboard') }}" class="btn btn-success btn-animated">
                                <i class="bi bi-speedometer2 me-2"></i> Bảng điều khiển học viên
                            </a>
                            <a href="{{ route('courses.index') }}" class="btn btn-outline-success btn-animated">
                                <i class="bi bi-search me-2"></i> Khám phá khóa học
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
