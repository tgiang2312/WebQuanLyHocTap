@extends('layouts.app')

@section('title', 'Đăng nhập / Đăng ký - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-lg-5 p-4">
                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold">Chào mừng đến với LearnHub</h1>
                        <p class="text-muted">Đăng nhập hoặc tạo tài khoản mới để bắt đầu học tập</p>
                    </div>
                    
                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-fill mb-4" id="authTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-medium" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-tab-pane" type="button" role="tab" aria-controls="login-tab-pane" aria-selected="true">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-medium" id="register-tab" data-bs-toggle="tab" data-bs-target="#register-tab-pane" type="button" role="tab" aria-controls="register-tab-pane" aria-selected="false">
                                <i class="bi bi-person-plus me-2"></i>Đăng ký
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="authTabContent">
                        <!-- Login Form -->
                        <div class="tab-pane fade show active" id="login-tab-pane" role="tabpanel" aria-labelledby="login-tab" tabindex="0">
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label for="password" class="form-label mb-0">Mật khẩu</label>
                                        <a href="#" class="text-decoration-none small">Quên mật khẩu?</a>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                                    </button>
                                </div>
                            </form>
                            
                            <div class="mt-4 text-center">
                                <p class="text-muted mb-0">Hoặc đăng nhập với</p>
                                <div class="d-flex justify-content-center gap-2 mt-3">
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="bi bi-facebook me-2"></i>Facebook
                                    </a>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="bi bi-google me-2"></i>Google
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Register Form -->
                        <div class="tab-pane fade" id="register-tab-pane" role="tabpanel" aria-labelledby="register-tab" tabindex="0">
                            <form action="{{ url('/register') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ và tên</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Nguyễn Văn A" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email_register" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" id="email_register" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_register" class="form-label">Mật khẩu</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" id="password_register" name="password" placeholder="••••••••" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="form-text">Mật khẩu phải có ít nhất 8 ký tự</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label d-block">Vai trò</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="role_student" value="student" checked>
                                        <label class="form-check-label" for="role_student">Học viên</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="role_teacher" value="teacher">
                                        <label class="form-check-label" for="role_teacher">Giảng viên</label>
                                    </div>
                                </div>
                                
                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Tôi đồng ý với <a href="#" class="text-decoration-none">Điều khoản sử dụng</a> và <a href="#" class="text-decoration-none">Chính sách bảo mật</a>
                                    </label>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-person-plus me-2"></i>Đăng ký
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <p class="mb-0">
                    Bạn gặp vấn đề khi đăng nhập?
                    <a href="{{ route('contact') }}" class="text-decoration-none">Liên hệ hỗ trợ</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
        
        // Set active tab based on URL parameter or data
        @if(isset($tab) && $tab === 'register')
            document.getElementById('register-tab').click();
        @else
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('tab') === 'register') {
                document.getElementById('register-tab').click();
            }
        @endif
    });
</script>
@endsection 