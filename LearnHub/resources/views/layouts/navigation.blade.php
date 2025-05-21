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
            
            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                            Khóa học
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            Giới thiệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            Liên hệ
                        </a>
                    </li>
                </ul>
                
                <!-- Search Form -->
                <form class="d-flex me-2">
                    <div class="input-group">
                        <span class="input-group-text bg-primary border-0 text-white">
                            <i class="bi bi-search"></i>
                        </span>
                        <input class="form-control bg-primary-subtle border-0 text-white" type="search" 
                               placeholder="Tìm kiếm khóa học..." aria-label="Search">
                    </div>
                </form>
                
                <!-- User Menu -->
                @auth
                    <div class="d-flex align-items-center">
                        <!-- Notifications -->
                        <div class="dropdown me-3">
                            <button class="btn btn-link text-white position-relative p-1" type="button" 
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger rounded-circle">
                                    <span class="visually-hidden">Thông báo mới</span>
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><h6 class="dropdown-header">Thông báo</h6></li>
                                <li><a class="dropdown-item" href="#">Bài giảng mới đã được thêm</a></li>
                                <li><a class="dropdown-item" href="#">Bài tập sắp đến hạn</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Xem tất cả thông báo</a></li>
                            </ul>
                        </div>
                        
                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-link d-flex align-items-center text-white text-decoration-none dropdown-toggle" 
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center me-2" 
                                     style="width: 32px; height: 32px;">
                                    <span class="fw-medium small">NT</span>
                                </div>
                                <span class="d-none d-md-block">{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="bi bi-person me-2"></i> Hồ sơ cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="bi bi-book me-2"></i> Khóa học của tôi
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="d-flex">
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="btn btn-light">Đăng ký</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</header>
