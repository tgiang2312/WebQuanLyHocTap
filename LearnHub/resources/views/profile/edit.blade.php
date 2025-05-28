@extends('layouts.app')

@section('title', 'Chỉnh sửa hồ sơ cá nhân - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <div class="profile-pic mb-3">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle img-fluid" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3" style="width: 120px; height: 120px;">
                                <i class="bi bi-person-circle text-primary" style="font-size: 60px; margin: auto;"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="fw-bold">{{ $user->name }}</h5>
                    <p class="text-muted mb-2">{{ $user->email }}</p>
                    
                    @if($user->role === 'admin')
                        <span class="badge bg-danger mb-3">Quản trị viên</span>
                    @elseif($user->role === 'teacher')
                        <span class="badge bg-primary mb-3">Giảng viên</span>
                    @else
                        <span class="badge bg-success mb-3">Học viên</span>
                    @endif
                    
                    <div class="d-grid">
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-primary">Xem hồ sơ</a>
                    </div>
                </div>
            </div>
            
            <div class="list-group shadow-sm">
                <a href="#profile-info" class="list-group-item list-group-item-action active">
                    <i class="bi bi-person me-2"></i> Thông tin cá nhân
                </a>
                <a href="#security" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-lock me-2"></i> Bảo mật
                </a>
                
                @if($user->role === 'teacher')
                <a href="#teacher-info" class="list-group-item list-group-item-action">
                    <i class="bi bi-mortarboard me-2"></i> Thông tin giảng viên
                </a>
                @endif
                
                <a href="#preferences" class="list-group-item list-group-item-action">
                    <i class="bi bi-gear me-2"></i> Tùy chỉnh
                </a>
                <a href="#delete-account" class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-trash me-2"></i> Xóa tài khoản
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div id="profile-info" class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Thông tin cá nhân</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Ảnh đại diện</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                            <div class="form-text">Định dạng JPG, PNG. Tối đa 2MB.</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="bio" class="form-label">Giới thiệu bản thân</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3">{{ $user->bio }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="birthday" class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $user->birthday }}">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                    </form>
                </div>
            </div>
            
            <div id="security" class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Bảo mật</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
            
            @if($user->role === 'teacher')
            <div id="teacher-info" class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Thông tin giảng viên</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Chức danh</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $user->title }}">
                            <div class="form-text">Ví dụ: Giảng viên, Tiến sĩ, Kỹ sư...</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="expertise" class="form-label">Lĩnh vực chuyên môn</label>
                            <input type="text" class="form-control" id="expertise" name="expertise" value="{{ $user->expertise }}">
                            <div class="form-text">Ví dụ: Lập trình web, Machine Learning, Thiết kế đồ họa...</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="experience" class="form-label">Kinh nghiệm</label>
                            <textarea class="form-control" id="experience" name="experience" rows="3">{{ $user->experience }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                    </form>
                </div>
            </div>
            @endif
            
            <div id="preferences" class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Tùy chỉnh</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Thông báo</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="email_notifications" name="email_notifications" {{ $user->email_notifications ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_notifications">Nhận thông báo qua email</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="language" class="form-label">Ngôn ngữ</label>
                            <select class="form-select" id="language" name="language">
                                <option value="vi" {{ $user->language == 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                                <option value="en" {{ $user->language == 'en' ? 'selected' : '' }}>English</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Lưu tùy chỉnh</button>
                    </form>
                </div>
            </div>
            
            <div id="delete-account" class="card shadow-sm border-danger">
                <div class="card-header bg-white text-danger">
                    <h5 class="card-title mb-0">Xóa tài khoản</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Khi xóa tài khoản, tất cả dữ liệu của bạn sẽ bị xóa vĩnh viễn và không thể khôi phục.</p>
                    
                    <form action="{{ route('profile.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-3">
                            <label for="delete_confirmation" class="form-label">Nhập "XÓA TÀI KHOẢN" để xác nhận</label>
                            <input type="text" class="form-control" id="delete_confirmation" name="delete_confirmation" required>
                            @error('delete_confirmation')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản? Hành động này không thể hoàn tác.')">Xóa tài khoản</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Scroll to hash section on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash) {
            const hash = window.location.hash;
            const element = document.querySelector(hash);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
                
                // Update active class in sidebar
                document.querySelectorAll('.list-group-item').forEach(item => {
                    item.classList.remove('active');
                });
                document.querySelector(`a[href="${hash}"]`).classList.add('active');
            }
        }
    });
    
    // Sidebar navigation
    document.querySelectorAll('.list-group-item').forEach(item => {
        item.addEventListener('click', function(e) {
            document.querySelectorAll('.list-group-item').forEach(i => {
                i.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
</script>
@endsection 