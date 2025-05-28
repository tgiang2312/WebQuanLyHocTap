<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="bi bi-book me-2 fs-4"></i>
                <span class="fw-bold fs-4">LearnHub</span>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" 
                    aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.index') ? 'active' : '' }}" href="{{ route('courses.index') }}">Khóa học</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Liên hệ</a>
                    </li>
                </ul>
                
                <!-- Right Side Navigation -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                        </li>
                    @else
                        @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-graph-up"></i> Thống kê người dùng
                            </a>
                        </li>
                        @endif
                        
                        @if(Auth::user()->role === 'teacher')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="teacherDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-2" width="28" height="28" style="object-fit: cover;">
                                    @else
                                        <i class="bi bi-person-workspace me-2"></i>
                                    @endif
                                    Giảng viên
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="teacherDropdown">
                                    <li><a class="dropdown-item" href="{{ route('teachers.dashboard') }}">Bảng điều khiển</a></li>
                                    <li><a class="dropdown-item" href="{{ route('teachers.courses') }}">Quản lý khóa học</a></li>
                                    <li><a class="dropdown-item" href="{{ route('teachers.assignments') }}">Quản lý bài tập</a></li>
                                    <li><a class="dropdown-item" href="{{ route('teachers.analytics') }}">Báo cáo thống kê</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('courses.create') }}">Tạo khóa học mới</a></li>
                                </ul>
                            </li>
                        @endif
                        
                        @if(Auth::user()->role === 'student')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="studentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-2" width="28" height="28" style="object-fit: cover;">
                                    @else
                                        <i class="bi bi-person-badge me-2"></i>
                                    @endif
                                    Học viên
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="studentDropdown">
                                    <li><a class="dropdown-item" href="{{ route('students.dashboard') }}">Bảng điều khiển</a></li>
                                    <li><a class="dropdown-item" href="{{ route('students.courses') }}">Khóa học của tôi</a></li>
                                    <li><a class="dropdown-item" href="{{ route('students.assignments') }}">Bài tập</a></li>
                                    <li><a class="dropdown-item" href="{{ route('students.achievements') }}">Thành tích</a></li>
                                </ul>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
                                @else
                                    <i class="bi bi-person-circle me-2"></i>
                                @endif
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <div class="dropdown-item d-flex align-items-center">
                                        @if(Auth::user()->avatar)
                                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <strong>{{ Auth::user()->name }}</strong>
                                            <div class="text-muted small">{{ Auth::user()->email }}</div>
                                            <div class="mt-1">
                                                @if(Auth::user()->role === 'admin')
                                                    <span class="badge bg-danger">Quản trị viên</span>
                                                @elseif(Auth::user()->role === 'teacher')
                                                    <span class="badge bg-primary">Giảng viên</span>
                                                @else
                                                    <span class="badge bg-success">Học viên</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Hồ sơ</a></li>
                                @if(Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-gear me-2"></i>Quản trị hệ thống</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
