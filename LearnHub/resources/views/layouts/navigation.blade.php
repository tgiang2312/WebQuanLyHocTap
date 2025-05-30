<header class="header-main">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <div class="logo-container me-2">
                    <img src="{{ asset('images/logo.jpg') }}" alt="LearnHub Logo" class="img-fluid">
                </div>
                <span class="logo-text gradient-text fw-bold">LearnHub</span>
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" 
                    aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2"></i>
            </button>
            
            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.index') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                            <i class="bi bi-book me-1"></i> Khóa học
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="bi bi-info-circle me-1"></i> Giới thiệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            <i class="bi bi-envelope me-1"></i> Liên hệ
                        </a>
                    </li>
                </ul>
                
                <!-- Right Side Navigation -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary rounded-pill px-4" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary rounded-pill px-4" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i> Đăng ký
                            </a>
                        </li>
                    @else
                        @if(Auth::user()->role === 'admin')
                        <li class="nav-item me-3">
                            <a class="nav-link btn btn-soft-danger rounded-pill px-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-graph-up"></i> Quản trị
                            </a>
                        </li>
                        @endif
                        
                        @if(Auth::user()->role === 'teacher')
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link dropdown-toggle btn btn-soft-primary rounded-pill px-3" href="#" id="teacherDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-workspace me-1"></i>
                                    Giảng viên
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2" aria-labelledby="teacherDropdown">
                                    <li><a class="dropdown-item" href="{{ route('teachers.dashboard') }}"><i class="bi bi-speedometer2 me-2 text-primary"></i>Bảng điều khiển</a></li>
                                    <li><a class="dropdown-item" href="{{ route('teachers.courses') }}"><i class="bi bi-journal-text me-2 text-primary"></i>Quản lý khóa học</a></li>
                                    <li><a class="dropdown-item" href="{{ route('teachers.assignments') }}"><i class="bi bi-file-earmark-text me-2 text-primary"></i>Quản lý bài tập</a></li>
                                    <li><a class="dropdown-item" href="{{ route('teachers.analytics') }}"><i class="bi bi-bar-chart me-2 text-primary"></i>Báo cáo thống kê</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('courses.create') }}"><i class="bi bi-plus-circle me-2 text-success"></i>Tạo khóa học mới</a></li>
                                </ul>
                            </li>
                        @endif
                        
                        @if(Auth::user()->role === 'student')
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link dropdown-toggle btn btn-soft-success rounded-pill px-3" href="#" id="studentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-badge me-1"></i>
                                    Học viên
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2" aria-labelledby="studentDropdown">
                                    <li><a class="dropdown-item" href="{{ route('students.dashboard') }}"><i class="bi bi-speedometer2 me-2 text-success"></i>Bảng điều khiển</a></li>
                                    <li><a class="dropdown-item" href="{{ route('students.courses') }}"><i class="bi bi-journal-text me-2 text-success"></i>Khóa học của tôi</a></li>
                                    <li><a class="dropdown-item" href="{{ route('students.assignments') }}"><i class="bi bi-file-earmark-text me-2 text-success"></i>Bài tập</a></li>
                                    <li><a class="dropdown-item" href="{{ route('students.achievements') }}"><i class="bi bi-trophy me-2 text-success"></i>Thành tích</a></li>
                                </ul>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-dropdown d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(Auth::user()->avatar_data || Auth::user()->avatar)
                                    <div class="avatar-container">
                                        <img src="{{ Auth::user()->avatarUrl }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-2" width="38" height="38" style="object-fit: cover;">
                                        <span class="avatar-status {{ Auth::user()->role === 'admin' ? 'bg-danger' : (Auth::user()->role === 'teacher' ? 'bg-primary' : 'bg-success') }}"></span>
                                    </div>
                                @else
                                    <div class="avatar-container">
                                        <div class="avatar-initials me-2">{{ substr(Auth::user()->name, 0, 1) }}</div>
                                        <span class="avatar-status {{ Auth::user()->role === 'admin' ? 'bg-danger' : (Auth::user()->role === 'teacher' ? 'bg-primary' : 'bg-success') }}"></span>
                                    </div>
                                @endif
                                <span class="d-none d-lg-inline-block ms-1">{{ Str::limit(Auth::user()->name, 15) }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2" aria-labelledby="navbarDropdown" style="min-width: 280px;">
                                <li>
                                    <div class="dropdown-item d-flex align-items-center border-bottom pb-3">
                                        @if(Auth::user()->avatar_data || Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatarUrl }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-3" width="50" height="50" style="object-fit: cover;">
                                        @else
                                            <div class="avatar-initials-lg me-3">{{ substr(Auth::user()->name, 0, 1) }}</div>
                                        @endif
                                        <div>
                                            <h6 class="fw-bold mb-0">{{ Auth::user()->name }}</h6>
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
                                <li class="dropdown-menu-links p-2">
                                    <a class="dropdown-item rounded-3" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person me-2"></i>Hồ sơ cá nhân
                                    </a>
                                @if(Auth::user()->role === 'admin')
                                        <a class="dropdown-item rounded-3" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-gear me-2"></i>Quản trị hệ thống
                                        </a>
                                @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger rounded-3">
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

<style>
.header-main {
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar {
    padding: 0.7rem 1rem;
    transition: all 0.3s ease;
}

.logo-container {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-text {
    font-size: 1.4rem;
    letter-spacing: 0.5px;
}

.nav-link {
    position: relative;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
    font-weight: 500;
}

.nav-link:hover {
    color: var(--bs-primary);
}

.nav-link.active {
    color: var(--bs-primary);
    font-weight: 600;
}

.nav-link.active:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 1rem;
    right: 1rem;
    height: 3px;
    border-radius: 10px;
    background-color: var(--bs-primary);
}

/* Avatar styling */
.avatar-container {
    position: relative;
    display: inline-block;
}

.avatar-status {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: 2px solid white;
}

.avatar-initials {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background-color: var(--bs-primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.avatar-initials-lg {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: var(--bs-primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
}

/* User dropdown styling */
.user-dropdown {
    border-radius: 30px;
    padding: 5px 10px;
    transition: all 0.3s ease;
}

.user-dropdown:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.1);
}

.dropdown-menu {
    padding: 0.5rem 0;
    overflow: hidden;
}

.dropdown-menu-links .dropdown-item {
    padding: 0.6rem 1rem;
    transition: all 0.3s ease;
}

.dropdown-menu-links .dropdown-item:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.1);
}

/* Soft background buttons */
.btn-soft-primary {
    background-color: rgba(var(--bs-primary-rgb), 0.15);
    color: var(--bs-primary);
    border: none;
}

.btn-soft-primary:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.25);
    color: var(--bs-primary);
}

.btn-soft-success {
    background-color: rgba(var(--bs-success-rgb), 0.15);
    color: var(--bs-success);
    border: none;
}

.btn-soft-success:hover {
    background-color: rgba(var(--bs-success-rgb), 0.25);
    color: var(--bs-success);
}

.btn-soft-danger {
    background-color: rgba(var(--bs-danger-rgb), 0.15);
    color: var(--bs-danger);
    border: none;
}

.btn-soft-danger:hover {
    background-color: rgba(var(--bs-danger-rgb), 0.25);
    color: var(--bs-danger);
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
    .navbar-collapse {
        background-color: white;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-top: 1rem;
    }

    .nav-link.active:after {
        display: none;
    }

    .nav-link.active {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
        border-radius: 5px;
    }
}
</style>
