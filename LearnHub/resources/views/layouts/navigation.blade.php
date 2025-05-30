<header class="sticky-top">
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-2">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="LearnHub Logo" height="40" class="me-2 rounded">
                <span class="fw-bold">LearnHub</span>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" 
                    aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.index') ? 'active fw-semibold' : '' }}" href="{{ route('courses.index') }}">
                            <i class="bi bi-book me-1"></i> Khóa học
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active fw-semibold' : '' }}" href="{{ route('about') }}">
                            <i class="bi bi-info-circle me-1"></i> Giới thiệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active fw-semibold' : '' }}" href="{{ route('contact') }}">
                            <i class="bi bi-envelope me-1"></i> Liên hệ
                        </a>
                    </li>
                </ul>
                
                <!-- Right Side Navigation -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light btn-sm me-2 px-3 py-1 mt-1" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-light text-primary btn-sm px-3 py-1 mt-1" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i> Đăng ký
                            </a>
                        </li>
                    @else
                        @if(Auth::user()->role === 'admin')
                        <li class="nav-item me-2">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-semibold' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-graph-up"></i> Thống kê
                            </a>
                        </li>
                        @endif
                        
                        @if(Auth::user()->role === 'teacher')
                            <li class="nav-item dropdown me-2">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="teacherDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-workspace me-1"></i>
                                    Giảng viên
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2" aria-labelledby="teacherDropdown">
                                    <li><a class="dropdown-item py-2" href="{{ route('teachers.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Bảng điều khiển</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('teachers.courses') }}"><i class="bi bi-journal-text me-2"></i>Quản lý khóa học</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('teachers.assignments') }}"><i class="bi bi-clipboard-check me-2"></i>Quản lý bài tập</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('teachers.analytics') }}"><i class="bi bi-bar-chart-line me-2"></i>Báo cáo thống kê</a></li>
                                </ul>
                            </li>
                        @endif
                        
                        @if(Auth::user()->role === 'student')
                            <li class="nav-item dropdown me-2">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="studentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-badge me-1"></i>
                                    Học viên
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2" aria-labelledby="studentDropdown">
                                    <li><a class="dropdown-item py-2" href="{{ route('students.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Bảng điều khiển</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('students.courses') }}"><i class="bi bi-journal-text me-2"></i>Khóa học của tôi</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('students.assignments') }}"><i class="bi bi-clipboard-check me-2"></i>Bài tập</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('students.achievements') }}"><i class="bi bi-trophy me-2"></i>Thành tích</a></li>
                                </ul>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(Auth::user()->avatar_data || Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatarUrl }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover; border: 2px solid rgba(255,255,255,0.3);">
                                @else
                                    <i class="bi bi-person-circle me-1"></i>
                                @endif
                                <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2" aria-labelledby="navbarDropdown">
                                <li>
                                    <div class="dropdown-item d-flex align-items-center">
                                        @if(Auth::user()->avatar_data || Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatarUrl }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-2" width="48" height="48" style="object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" style="width: 48px; height: 48px;">
                                                <i class="bi bi-person fs-4 text-secondary"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <strong class="d-block">{{ Auth::user()->name }}</strong>
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
                                <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Hồ sơ</a></li>
                                @if(Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-gear me-2"></i>Quản trị hệ thống</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger py-2">
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
