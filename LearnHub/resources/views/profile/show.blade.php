@extends('layouts.app')

@section('title', 'Hồ sơ người dùng - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="bg-primary bg-opacity-10 p-4 text-center">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-white rounded-circle d-inline-flex p-3 mb-3" style="width: 150px; height: 150px;">
                                <i class="bi bi-person-circle text-primary" style="font-size: 80px; margin: auto;"></i>
                            </div>
                        @endif
                        
                        <h2 class="fw-bold">{{ $user->name }}</h2>
                        
                        @if($user->role === 'admin')
                            <span class="badge bg-danger mb-2">Quản trị viên</span>
                        @elseif($user->role === 'teacher')
                            <span class="badge bg-primary mb-2">Giảng viên</span>
                            @if($user->title)
                                <p class="mb-1">{{ $user->title }}</p>
                            @endif
                        @else
                            <span class="badge bg-success mb-2">Học viên</span>
                        @endif
                        
                        <div class="d-flex justify-content-center mt-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">
                                <i class="bi bi-pencil me-1"></i> Chỉnh sửa hồ sơ
                            </a>
                            
                            @if($user->role === 'teacher')
                                <a href="{{ route('teachers.dashboard') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-speedometer2 me-1"></i> Bảng điều khiển
                                </a>
                            @elseif($user->role === 'student')
                                <a href="{{ route('students.dashboard') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-speedometer2 me-1"></i> Bảng điều khiển
                                </a>
                            @else
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-speedometer2 me-1"></i> Quản trị hệ thống
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h4 class="border-bottom pb-2 mb-3">Thông tin cá nhân</h4>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Email</p>
                                <p class="fw-bold">{{ $user->email }}</p>
                            </div>
                            
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Số điện thoại</p>
                                <p class="fw-bold">{{ $user->phone ?? 'Chưa cập nhật' }}</p>
                            </div>
                        </div>
                        
                        @if($user->bio)
                            <div class="mb-4">
                                <p class="text-muted mb-1">Giới thiệu bản thân</p>
                                <p>{{ $user->bio }}</p>
                            </div>
                        @endif
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Ngày sinh</p>
                                <p class="fw-bold">{{ $user->birthday ? date('d/m/Y', strtotime($user->birthday)) : 'Chưa cập nhật' }}</p>
                            </div>
                            
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Ngày tham gia</p>
                                <p class="fw-bold">{{ date('d/m/Y', strtotime($user->created_at)) }}</p>
                            </div>
                        </div>
                        
                        @if($user->role === 'teacher')
                            <h4 class="border-bottom pb-2 mb-3 mt-5">Thông tin giảng viên</h4>
                            
                            @if($user->expertise)
                                <div class="mb-4">
                                    <p class="text-muted mb-1">Lĩnh vực chuyên môn</p>
                                    <p>{{ $user->expertise }}</p>
                                </div>
                            @endif
                            
                            @if($user->experience)
                                <div class="mb-4">
                                    <p class="text-muted mb-1">Kinh nghiệm</p>
                                    <p>{{ $user->experience }}</p>
                                </div>
                            @endif
                            
                            <div class="mb-4">
                                <p class="text-muted mb-1">Số khóa học đã tạo</p>
                                <p class="fw-bold">{{ $user->courses_count ?? 0 }}</p>
                            </div>
                        @endif
                        
                        @if($user->role === 'student')
                            <h4 class="border-bottom pb-2 mb-3 mt-5">Hoạt động học tập</h4>
                            
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h1 class="text-primary fw-bold">{{ $user->enrollments_count ?? 0 }}</h1>
                                            <p class="text-muted">Khóa học đã đăng ký</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h1 class="text-success fw-bold">{{ $user->completed_courses_count ?? 0 }}</h1>
                                            <p class="text-muted">Khóa học đã hoàn thành</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h1 class="text-warning fw-bold">{{ $user->achievements_count ?? 0 }}</h1>
                                            <p class="text-muted">Thành tích đạt được</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 