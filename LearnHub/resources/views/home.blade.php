@extends('layouts.app')

@section('title', 'Trang chủ - LearnHub')

@section('content')
<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden">
    <!-- Animated Background -->
    <div class="hero-bg">
    <div class="hero-image-container">
            <img src="{{ asset('images/home.jpg') }}" alt="LearnHub Background" class="hero-image">
        <div class="hero-overlay"></div>
    </div>
        
        <!-- Particles Animation -->
        <div id="particles-js" class="particles-container"></div>
    </div>
    
    <!-- Animated Shapes -->
    <div class="animated-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
        <div class="shape shape-6"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="container position-relative py-5">
        <div class="row align-items-center min-vh-80">
            <div class="col-lg-6 py-4 hero-content">
                <div class="hero-badge mb-4">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                        <i class="bi bi-lightning-charge-fill me-1"></i>
                        Nền tảng học tập trực tuyến #1 Việt Nam
                    </span>
                </div>
                
                <h1 class="display-3 fw-bold text-white hero-title">
                    <span class="d-block mb-2">Phát triển kỹ năng cùng</span>
                    <span class="hero-gradient-text">LearnHub</span>
                </h1>
                
                <p class="lead mb-4 text-white hero-subtitle">
                    Khám phá hơn 200+ khóa học chất lượng cao từ các chuyên gia hàng đầu, 
                    giúp bạn làm chủ kỹ năng mới và nâng cao sự nghiệp.
                </p>
                
                <div class="d-flex flex-wrap gap-3 hero-cta">
                    <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg btn-glow">
                        <span>Khám phá khóa học</span>
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-glass btn-lg">
                            <span>Đăng nhập</span>
                            <i class="bi bi-box-arrow-in-right ms-2"></i>
                        </a>
                    @endguest
                </div>
                
                <!-- Trusted By -->
                <div class="trusted-by mt-5">
                    <p class="text-white-50 mb-3 small">Được tin dùng bởi:</p>
                    <div class="trusted-logos">
                        <!-- Sử dụng logo từ thư mục hiện có với fallback -->
                        <img src="{{ asset('images/logo.jpg') }}" alt="Company 1" class="trusted-logo">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Company 2" class="trusted-logo">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Company 3" class="trusted-logo">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Company 4" class="trusted-logo">
            </div>
                </div>
            </div>
            
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-image-wrapper">
                    <div class="hero-image-float">
                        <img src="{{ asset('images/home.jpg') }}" alt="Learning Illustration" class="img-fluid hero-main-image">
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="floating-card floating-card-1">
                        <div class="floating-icon bg-success">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="floating-text">
                            <p class="mb-0 fw-semibold">10,000+ Học viên</p>
                            <p class="mb-0 small text-success">Đã đăng ký</p>
                        </div>
                    </div>
                    
                    <div class="floating-card floating-card-2">
                        <div class="floating-icon bg-warning">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="floating-text">
                            <p class="mb-0 fw-semibold">4.8/5 Sao</p>
                            <p class="mb-0 small text-warning">Đánh giá trung bình</p>
                        </div>
                    </div>
                    
                    <div class="floating-card floating-card-3">
                        <div class="floating-icon bg-info">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <div class="floating-text">
                            <p class="mb-0 fw-semibold">Học mọi lúc, mọi nơi</p>
                            <p class="mb-0 small text-info">Trên mọi thiết bị</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Wave Divider -->
    <div class="wave-divider">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
        </svg>
    </div>
    
    <!-- Mouse Scroll Indicator -->
    <div class="scroll-down-indicator">
        <div class="mouse">
            <div class="wheel"></div>
        </div>
        <div class="arrows">
            <span class="arrow-down"></span>
            <span class="arrow-down"></span>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Features section -->
    <div class="section-heading text-center mb-5 reveal-section">
        <span class="subtitle">Tại sao chọn chúng tôi</span>
        <h2 class="title-gradient fw-bold">Tại sao chọn LearnHub?</h2>
        <p class="lead text-muted">Nền tảng cung cấp mọi thứ bạn cần để phát triển kỹ năng mới</p>
        <div class="section-separator">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    
    <div class="row g-4 mb-5 features-cards">
        <div class="col-md-4">
            <div class="card feature-card border-0 shadow-sm h-100 text-center p-4">
                <div class="icon-wrapper mx-auto mb-4">
                    <div class="icon-bg bg-primary"></div>
                    <i class="bi bi-collection-play feature-icon text-primary"></i>
                </div>
                <h3 class="fw-semibold h4">Khóa học chất lượng</h3>
                <p class="text-muted">Học từ những giáo viên giàu kinh nghiệm với nội dung bài học cập nhật liên tục.</p>
                <div class="hover-reveal">
                    <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary rounded-pill mt-3">Xem khóa học</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card feature-card border-0 shadow-sm h-100 text-center p-4">
                <div class="icon-wrapper mx-auto mb-4">
                    <div class="icon-bg bg-success"></div>
                    <i class="bi bi-people feature-icon text-success"></i>
                </div>
                <h3 class="fw-semibold h4">Cộng đồng hỗ trợ</h3>
                <p class="text-muted">Kết nối và học hỏi cùng cộng đồng học viên và giáo viên trên toàn quốc.</p>
                <div class="hover-reveal">
                    <a href="{{ route('about') }}" class="btn btn-sm btn-outline-success rounded-pill mt-3">Tìm hiểu thêm</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card feature-card border-0 shadow-sm h-100 text-center p-4">
                <div class="icon-wrapper mx-auto mb-4">
                    <div class="icon-bg bg-warning"></div>
                    <i class="bi bi-clock-history feature-icon text-warning"></i>
                </div>
                <h3 class="fw-semibold h4">Học mọi lúc, mọi nơi</h3>
                <p class="text-muted">Tiếp cận bài học mọi lúc, mọi nơi trên mọi thiết bị với giao diện thân thiện.</p>
                <div class="hover-reveal">
                    <a href="{{ route('register') }}" class="btn btn-sm btn-outline-warning rounded-pill mt-3">Đăng ký ngay</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Course Categories -->
    <div class="mb-5 reveal-section">
        <div class="section-heading d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="subtitle">Danh mục</span>
                <h2 class="title-gradient fw-bold mb-0">Khám phá danh mục</h2>
            </div>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary rounded-pill">
                <span>Xem tất cả</span>
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
        
        <div class="category-wrapper">
            <div class="row g-4 categories-slider">
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.category', 'lap-trinh') }}" class="text-decoration-none category-card-link">
                        <div class="card category-card bg-primary bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <div class="category-icon-wrapper mb-3">
                                    <i class="bi bi-code-square text-primary category-icon"></i>
                                </div>
                                <h5 class="fw-semibold">Lập trình</h5>
                                <p class="small text-muted mb-0">0 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.category', 'marketing') }}" class="text-decoration-none category-card-link">
                        <div class="card category-card bg-success bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <div class="category-icon-wrapper mb-3">
                                    <i class="bi bi-graph-up-arrow text-success category-icon"></i>
                                </div>
                                <h5 class="fw-semibold">Marketing</h5>
                                <p class="small text-muted mb-0">0 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.category', 'thiet-ke') }}" class="text-decoration-none category-card-link">
                        <div class="card category-card bg-danger bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <div class="category-icon-wrapper mb-3">
                                    <i class="bi bi-brush text-danger category-icon"></i>
                                </div>
                                <h5 class="fw-semibold">Thiết kế</h5>
                                <p class="small text-muted mb-0">0 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.category', 'kinh-doanh') }}" class="text-decoration-none category-card-link">
                        <div class="card category-card bg-warning bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <div class="category-icon-wrapper mb-3">
                                    <i class="bi bi-briefcase text-warning category-icon"></i>
                                </div>
                                <h5 class="fw-semibold">Kinh doanh</h5>
                                <p class="small text-muted mb-0">0 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.category', 'ngoai-ngu') }}" class="text-decoration-none category-card-link">
                        <div class="card category-card bg-info bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <div class="category-icon-wrapper mb-3">
                                    <i class="bi bi-translate text-info category-icon"></i>
                                </div>
                                <h5 class="fw-semibold">Ngoại ngữ</h5>
                                <p class="small text-muted mb-0">0 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('courses.index') }}" class="text-decoration-none category-card-link">
                        <div class="card category-card bg-secondary bg-opacity-10 border-0 h-100 text-center">
                            <div class="card-body py-4">
                                <div class="category-icon-wrapper mb-3">
                                    <i class="bi bi-grid-3x3-gap text-secondary category-icon"></i>
                                </div>
                                <h5 class="fw-semibold">Tất cả</h5>
                                <p class="small text-muted mb-0">0 khóa học</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Popular courses section -->
    <div class="mb-5 course-section reveal-section">
        <div class="section-heading d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="subtitle">Khóa học nổi bật</span>
                <h2 class="title-gradient fw-bold mb-0">Khóa học được yêu thích</h2>
            </div>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary rounded-pill">
                <span>Xem tất cả</span>
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
        
        <div class="popular-courses-container">
            <div class="course-card-wrapper">
                <div class="course-card-featured">
                    <div class="card border-0 shadow-hover h-100 course-card-large">
                        <div class="row g-0 h-100">
                            <div class="col-md-6 position-relative">
                                <div class="course-image-container h-100">
                                    <img src="{{ asset('images/course1.jpg') }}" class="img-fluid rounded-start h-100 w-100 object-cover" alt="Laravel">
                                    <div class="course-overlay-gradient"></div>
                                    <div class="course-featured-badge">
                                        <span class="badge bg-warning">HOT</span>
                        </div>
                    </div>
                    </div>
                            <div class="col-md-6">
                                <div class="card-body d-flex flex-column h-100 p-4">
                                    <div class="d-flex justify-content-between">
                                        <span class="badge bg-primary mb-2 rounded-pill px-3 py-2">Lập trình</span>
                                        <div class="course-rating">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <span class="fw-semibold">4.8</span>
                                            <span class="text-muted">(256)</span>
                </div>
            </div>
            
                                    <h3 class="card-title fw-bold h4 mb-3">Lập trình web với Laravel Framework</h3>
                                    
                                    <p class="card-text text-muted mb-4">Học cách xây dựng website đầy đủ chức năng với Laravel Framework, từ cơ bản đến nâng cao.</p>
                                    
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/user1.jpg') }}" alt="Instructor" class="rounded-circle me-2" width="40" height="40">
                                            <span>Nguyễn Văn A</span>
                        </div>
                    </div>
                                    
                                    <div class="course-stats d-flex justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-collection me-2 text-primary"></i>
                                            <span>25 bài học</span>
                    </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock me-2 text-success"></i>
                                            <span>15 giờ</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-bar-chart me-2 text-danger"></i>
                                            <span>Nâng cao</span>
                </div>
            </div>
            
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <div class="course-price">
                                            <span class="fw-bold text-primary fs-4">1.200.000₫</span>
                                        </div>
                                        <a href="#" class="btn btn-primary rounded-pill px-4">Đăng ký học</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row g-4 mt-4 course-grid">
            <div class="col-md-4">
                        <div class="card course-card-modern border-0 shadow-hover h-100">
                            <div class="course-image-wrapper">
                                <img src="{{ asset('images/course2.jpg') }}" class="card-img-top" alt="Course">
                                <div class="course-image-overlay"></div>
                                <div class="course-badge-wrapper">
                                    <span class="badge bg-success rounded-pill">Marketing</span>
                        </div>
                                <a href="#" class="btn-view-course">
                                    <span>Xem chi tiết</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                    </div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="course-rating">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <span class="fw-semibold">4.5</span>
                                        <span class="text-muted">(128)</span>
                    </div>
                                    <div class="course-level">
                                        <span class="badge bg-light text-dark">Cơ bản</span>
                </div>
            </div>
                                
                                <h5 class="card-title fw-bold mb-3">Digital Marketing cơ bản</h5>
                                
                                <div class="course-stats d-flex justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-collection me-1 text-muted"></i>
                                        <span class="small text-muted">12 bài</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-clock me-1 text-muted"></i>
                                        <span class="small text-muted">8 giờ</span>
        </div>
    </div>
    
                                <div class="d-flex align-items-center mb-4">
                                    <img src="{{ asset('images/user2.jpg') }}" alt="Instructor" class="rounded-circle me-2" width="30" height="30">
                                    <span class="small">Trần Thị B</span>
        </div>
        
                                <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                    <span class="fw-bold text-primary">990.000₫</span>
                                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Đăng ký</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
            <div class="col-md-4">
                        <div class="card course-card-modern border-0 shadow-hover h-100">
                            <div class="course-image-wrapper">
                                <img src="{{ asset('images/course3.jpg') }}" class="card-img-top" alt="Course">
                                <div class="course-image-overlay"></div>
                                <div class="course-badge-wrapper">
                                    <span class="badge bg-danger rounded-pill">Thiết kế</span>
                        </div>
                                <a href="#" class="btn-view-course">
                                    <span>Xem chi tiết</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                    </div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="course-rating">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <span class="fw-semibold">4.9</span>
                                        <span class="text-muted">(315)</span>
                        </div>
                                    <div class="course-level">
                                        <span class="badge bg-light text-dark">Trung cấp</span>
                        </div>
                    </div>
                                
                                <h5 class="card-title fw-bold mb-3">UI/UX Design cho người mới bắt đầu</h5>
                                
                                <div class="course-stats d-flex justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-collection me-1 text-muted"></i>
                                        <span class="small text-muted">18 bài</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-clock me-1 text-muted"></i>
                                        <span class="small text-muted">12 giờ</span>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-4">
                                    <img src="{{ asset('images/user3.jpg') }}" alt="Instructor" class="rounded-circle me-2" width="30" height="30">
                                    <span class="small">Lê Văn C</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                    <span class="fw-bold text-primary">1.500.000₫</span>
                                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Đăng ký</a>
                                </div>
                            </div>
                </div>
            </div>
            
            <div class="col-md-4">
                        <div class="card course-card-modern border-0 shadow-hover h-100">
                            <div class="course-image-wrapper">
                                <img src="{{ asset('images/course1.jpg') }}" class="card-img-top" alt="Course">
                                <div class="course-image-overlay"></div>
                                <div class="course-badge-wrapper">
                                    <span class="badge bg-info rounded-pill">Phát triển bản thân</span>
                        </div>
                                <a href="#" class="btn-view-course">
                                    <span>Xem chi tiết</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                    </div>
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="course-rating">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <span class="fw-semibold">4.7</span>
                                        <span class="text-muted">(98)</span>
                        </div>
                                    <div class="course-level">
                                        <span class="badge bg-light text-dark">Mọi cấp độ</span>
                        </div>
                    </div>
                                
                                <h5 class="card-title fw-bold mb-3">Phương pháp học tập hiệu quả</h5>
                                
                                <div class="course-stats d-flex justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-collection me-1 text-muted"></i>
                                        <span class="small text-muted">10 bài</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-clock me-1 text-muted"></i>
                                        <span class="small text-muted">6 giờ</span>
                </div>
            </div>
            
                                <div class="d-flex align-items-center mb-4">
                                    <img src="{{ asset('images/user1.jpg') }}" alt="Instructor" class="rounded-circle me-2" width="30" height="30">
                                    <span class="small">Nguyễn Văn A</span>
                        </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                    <span class="fw-bold text-primary">750.000₫</span>
                                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Đăng ký</a>
                    </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Learning Roadmap Section -->
    <div class="py-5 reveal-section">
        <div class="section-heading text-center mb-5">
            <span class="subtitle">Lộ trình</span>
            <h2 class="title-gradient fw-bold">Lộ trình học tập</h2>
            <p class="lead text-muted">Khám phá con đường phát triển kỹ năng chuyên nghiệp</p>
            <div class="section-separator">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        
        <div class="roadmap-container">
            <div class="roadmap-line"></div>
            
            <div class="row align-items-center justify-content-center">
                <div class="col-md-3">
                    <div class="roadmap-item">
                        <div class="roadmap-point"></div>
                        <div class="roadmap-content">
                            <div class="roadmap-icon">
                                <i class="bi bi-book"></i>
                            </div>
                            <h4 class="roadmap-title">Kiến thức nền tảng</h4>
                            <p class="roadmap-text">Xây dựng nền tảng vững chắc với các khóa học cơ bản</p>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill mt-2 roadmap-btn">Bắt đầu</a>
                    </div>
                </div>
            </div>
            
                <div class="col-md-3">
                    <div class="roadmap-item">
                        <div class="roadmap-point"></div>
                        <div class="roadmap-content">
                            <div class="roadmap-icon">
                                <i class="bi bi-code-square"></i>
                            </div>
                            <h4 class="roadmap-title">Kỹ năng chuyên sâu</h4>
                            <p class="roadmap-text">Phát triển kỹ năng chuyên môn với các khóa học nâng cao</p>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill mt-2 roadmap-btn">Khám phá</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="roadmap-item">
                        <div class="roadmap-point"></div>
                        <div class="roadmap-content">
                            <div class="roadmap-icon">
                                <i class="bi bi-diagram-3"></i>
                            </div>
                            <h4 class="roadmap-title">Dự án thực tế</h4>
                            <p class="roadmap-text">Áp dụng kiến thức vào các dự án thực tế để tích lũy kinh nghiệm</p>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill mt-2 roadmap-btn">Tham gia</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="roadmap-item">
                        <div class="roadmap-point"></div>
                        <div class="roadmap-content">
                            <div class="roadmap-icon">
                                <i class="bi bi-award"></i>
                            </div>
                            <h4 class="roadmap-title">Chứng chỉ & Nghề nghiệp</h4>
                            <p class="roadmap-text">Nhận chứng chỉ và kết nối với cơ hội nghề nghiệp</p>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill mt-2 roadmap-btn">Tìm hiểu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tại sao chọn LearnHub? Section -->
    <div class="why-choose-section py-5 reveal-section">
        <div class="section-heading text-center mb-5">
            <span class="subtitle">TẠI SAO CHỌN CHÚNG TÔI</span>
            <h2 class="title-gradient fw-bold">Tại sao chọn LearnHub?</h2>
            <p class="lead text-muted">Nền tảng cung cấp mọi thứ bạn cần để phát triển kỹ năng mới</p>
            <div class="section-separator">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        
        <div class="container">
            <div class="row g-4 why-choose-cards">
            <div class="col-md-4">
                    <div class="why-choose-card">
                        <div class="why-choose-icon">
                            <div class="icon-circle">
                                <i class="bi bi-play-btn"></i>
                        </div>
                    </div>
                        <div class="why-choose-content">
                            <h3 class="why-choose-title">Khóa học chất lượng</h3>
                            <p class="why-choose-text">Học từ những giáo viên giàu kinh nghiệm với nội dung bài học cập nhật liên tục.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                    <div class="why-choose-card">
                        <div class="why-choose-icon">
                            <div class="icon-circle">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="why-choose-content">
                            <h3 class="why-choose-title">Cộng đồng hỗ trợ</h3>
                            <p class="why-choose-text">Kết nối và học hỏi cùng cộng đồng học viên và giáo viên trên toàn quốc.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                    <div class="why-choose-card">
                        <div class="why-choose-icon">
                            <div class="icon-circle">
                                <i class="bi bi-clock-history"></i>
                        </div>
                    </div>
                        <div class="why-choose-content">
                            <h3 class="why-choose-title">Học mọi lúc, mọi nơi</h3>
                            <p class="why-choose-text">Tiếp cận bài học mọi lúc, mọi nơi trên mọi thiết bị với giao diện thân thiện.</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            
    <!-- Technology Stack Section -->
    <div class="tech-stack-section py-5 reveal-section">
        <div class="section-heading text-center mb-5">
            <span class="subtitle">Công nghệ</span>
            <h2 class="title-gradient fw-bold">Công nghệ bạn sẽ học</h2>
            <p class="lead text-muted">Các công nghệ hiện đại được ứng dụng trong khóa học</p>
            <div class="section-separator">
                <span></span>
                <span></span>
                <span></span>
                    </div>
                </div>
    
        <div class="tech-slider">
            <div class="tech-track">
                <!-- Lặp lại 2 lần để hiệu ứng vô hạn -->
                <div class="tech-slide"><img src="{{ asset('images/tech/html.png') }}" alt="HTML"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/css.png') }}" alt="CSS"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/js.png') }}" alt="JavaScript"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/php.png') }}" alt="PHP"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/laravel.png') }}" alt="Laravel"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/react.png') }}" alt="React"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/vue.png') }}" alt="Vue"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/node.png') }}" alt="Node.js"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/python.png') }}" alt="Python"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/mysql.png') }}" alt="MySQL"></div>
                
                <!-- Lặp lại để tạo hiệu ứng vô hạn -->
                <div class="tech-slide"><img src="{{ asset('images/tech/html.png') }}" alt="HTML"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/css.png') }}" alt="CSS"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/js.png') }}" alt="JavaScript"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/php.png') }}" alt="PHP"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/laravel.png') }}" alt="Laravel"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/react.png') }}" alt="React"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/vue.png') }}" alt="Vue"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/node.png') }}" alt="Node.js"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/python.png') }}" alt="Python"></div>
                <div class="tech-slide"><img src="{{ asset('images/tech/mysql.png') }}" alt="MySQL"></div>
            </div>
        </div>
    </div>
    
    <!-- CTA Section -->
    <div class="cta-section py-5 my-5 reveal-section">
        <div class="cta-bg-wrapper">
            <div class="cta-bg-overlay"></div>
                    </div>
        <div class="container py-5 position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center text-white">
                    <h2 class="display-5 fw-bold mb-4 cta-title">Sẵn sàng bắt đầu hành trình học tập?</h2>
                    <p class="lead mb-4 cta-text">Đăng ký ngay hôm nay để tiếp cận hàng trăm khóa học chất lượng và phát triển kỹ năng của bạn.</p>
                    <div class="d-flex justify-content-center gap-3 cta-buttons">
                        <a href="{{ route('courses.index') }}" class="btn btn-light btn-lg btn-animated px-5">
                            <span>Khám phá khóa học</span>
                            <i class="bi bi-book ms-2"></i>
                        </a>
            @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg btn-hover-slide px-5">
                            <span>Đăng ký ngay</span>
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
            @endguest
        </div>
                    <div class="cta-floating-elements">
                        <div class="floating-element el-1"><i class="bi bi-book"></i></div>
                        <div class="floating-element el-2"><i class="bi bi-lightbulb"></i></div>
                        <div class="floating-element el-3"><i class="bi bi-graph-up"></i></div>
                        <div class="floating-element el-4"><i class="bi bi-pencil"></i></div>
    </div>
</div>
            </div>
                </div>
            </div>
            
    <!-- Blog Section -->
    <div class="blog-section py-5 reveal-section">
        <div class="section-heading d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="subtitle">Tin tức & Blog</span>
                <h2 class="title-gradient fw-bold mb-0">Bài viết mới nhất</h2>
            </div>
            <a href="#" class="btn btn-outline-primary rounded-pill">
                <span>Tất cả bài viết</span>
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
        
        <div class="row g-4 blog-cards">
            <div class="col-md-4">
                <div class="blog-card">
                    <div class="blog-card-image">
                        <img src="{{ asset('images/blog1.jpg') }}" alt="Blog post">
                        <div class="blog-date">
                            <span class="day">15</span>
                            <span class="month">Th6</span>
                        </div>
                    </div>
                    <div class="blog-card-content">
                        <div class="blog-card-category">
                            <span><i class="bi bi-tag"></i> Tin tức</span>
                        </div>
                        <h3 class="blog-card-title">10 kỹ năng lập trình cần thiết cho năm 2023</h3>
                        <p class="blog-card-excerpt">Khám phá những kỹ năng lập trình đang được săn đón nhất trên thị trường việc làm hiện nay.</p>
                        <div class="blog-card-footer">
                            <div class="blog-author">
                                <img src="{{ asset('images/user1.jpg') }}" alt="Author" class="author-avatar">
                                <span>Nguyễn Văn A</span>
                            </div>
                            <a href="#" class="blog-read-more">Đọc tiếp <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="blog-card">
                    <div class="blog-card-image">
                        <img src="{{ asset('images/blog2.jpg') }}" alt="Blog post">
                        <div class="blog-date">
                            <span class="day">10</span>
                            <span class="month">Th6</span>
                    </div>
                </div>
                    <div class="blog-card-content">
                        <div class="blog-card-category">
                            <span><i class="bi bi-tag"></i> Hướng dẫn</span>
            </div>
                        <h3 class="blog-card-title">Làm thế nào để học lập trình hiệu quả</h3>
                        <p class="blog-card-excerpt">Những phương pháp học tập giúp bạn tiếp thu kiến thức lập trình nhanh chóng và hiệu quả.</p>
                        <div class="blog-card-footer">
                            <div class="blog-author">
                                <img src="{{ asset('images/user2.jpg') }}" alt="Author" class="author-avatar">
                                <span>Trần Thị B</span>
                            </div>
                            <a href="#" class="blog-read-more">Đọc tiếp <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="blog-card">
                    <div class="blog-card-image">
                        <img src="{{ asset('images/blog3.jpg') }}" alt="Blog post">
                        <div class="blog-date">
                            <span class="day">05</span>
                            <span class="month">Th6</span>
                    </div>
                </div>
                    <div class="blog-card-content">
                        <div class="blog-card-category">
                            <span><i class="bi bi-tag"></i> Công nghệ</span>
            </div>
                        <h3 class="blog-card-title">AI và tương lai của giáo dục trực tuyến</h3>
                        <p class="blog-card-excerpt">Trí tuệ nhân tạo đang thay đổi cách chúng ta học tập và tiếp cận kiến thức như thế nào?</p>
                        <div class="blog-card-footer">
                            <div class="blog-author">
                                <img src="{{ asset('images/user3.jpg') }}" alt="Author" class="author-avatar">
                                <span>Lê Văn C</span>
                            </div>
                            <a href="#" class="blog-read-more">Đọc tiếp <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stats Section -->
    <div class="stats-section py-5 reveal-section">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center">
                        <div class="stat-icon">
                            <i class="bi bi-person-check"></i>
        </div>
                        <h2 class="stat-number counter-up" data-target="10000">0</h2>
                        <p class="stat-title">Học viên</p>
    </div>
</div>
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center">
                        <div class="stat-icon">
                            <i class="bi bi-collection"></i>
                        </div>
                        <h2 class="stat-number counter-up" data-target="200">0</h2>
                        <p class="stat-title">Khóa học</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center">
                        <div class="stat-icon">
                            <i class="bi bi-person-video3"></i>
                        </div>
                        <h2 class="stat-number counter-up" data-target="50">0</h2>
                        <p class="stat-title">Giảng viên</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center">
                        <div class="stat-icon">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h2 class="stat-number counter-up" data-target="98">0</h2>
                        <p class="stat-title">% Hài lòng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Home Page Styles -->
<style>
/* Hero Section Styles */
.hero-section {
    min-height: 100vh;
    position: relative;
    background-color: var(--bs-dark);
    overflow: hidden;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.hero-image-container {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    filter: brightness(0.7) blur(2px);
    transform: scale(1.05);
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 50%, rgba(0,0,0,0.8) 100%);
    z-index: 1;
}

.particles-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
}

/* Fallback animation cho khi particles-js không hoạt động */
@keyframes gradientAnimation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

.hero-bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(-45deg, rgba(71, 118, 230, 0.1), rgba(142, 84, 233, 0.1), rgba(255, 64, 129, 0.1));
    background-size: 400% 400%;
    animation: gradientAnimation 15s ease infinite;
    z-index: 1;
}

.min-vh-80 {
    min-height: 80vh;
}

.hero-content {
    position: relative;
    z-index: 10;
}

.hero-badge {
    animation: fadeInDown 1s ease-out;
}

.hero-title {
    font-weight: 800;
    line-height: 1.2;
    animation: fadeInUp 1s ease-out 0.3s;
    animation-fill-mode: both;
}

.hero-gradient-text {
    background: linear-gradient(90deg, #4776E6 0%, #8E54E9 50%, #FF4081 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent; /* Fallback */
    display: inline-block;
    position: relative;
}

.hero-gradient-text::after {
    content: 'LearnHub';
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, #4776E6 0%, #8E54E9 50%, #FF4081 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent; /* Fallback */
    filter: blur(8px);
    opacity: 0.7;
    z-index: -1;
}

.hero-subtitle {
    max-width: 540px;
    animation: fadeInUp 1s ease-out 0.6s;
    animation-fill-mode: both;
}

.hero-cta {
    animation: fadeInUp 1s ease-out 0.9s;
    animation-fill-mode: both;
}

.btn-glow {
    position: relative;
    overflow: hidden;
    border: none;
    background: linear-gradient(90deg, #4776E6 0%, #8E54E9 100%);
    box-shadow: 0 5px 15px rgba(71, 118, 230, 0.4);
        transition: all 0.3s ease;
    }
    
.btn-glow:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(71, 118, 230, 0.6);
}

.btn-glow::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(60deg, transparent, rgba(255,255,255,0.3), transparent);
    transform: rotate(45deg);
    animation: glow 3s linear infinite;
}

@keyframes glow {
    0% {
        transform: rotate(45deg) translateX(-100%);
    }
    100% {
        transform: rotate(45deg) translateX(100%);
    }
}

.btn-glass {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
    transition: all 0.3s ease;
}

/* Fallback cho trình duyệt không hỗ trợ backdrop-filter */
@supports not ((backdrop-filter: blur(10px)) or (-webkit-backdrop-filter: blur(10px))) {
    .btn-glass {
        background: rgba(255, 255, 255, 0.2);
    }
}

.btn-glass:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.3);
    color: white;
    transform: translateY(-3px);
}

.trusted-by {
    animation: fadeInUp 1s ease-out 1.2s;
    animation-fill-mode: both;
}

.trusted-logos {
    display: flex;
    align-items: center;
    gap: 20px;
}

.trusted-logo {
    height: 30px;
    opacity: 0.7;
    filter: brightness(0) invert(1);
    transition: all 0.3s ease;
}

.trusted-logo:hover {
    opacity: 1;
}

.hero-image-wrapper {
    position: relative;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: fadeIn 1.5s ease-out;
}

.hero-main-image {
    position: relative;
    z-index: 3;
    filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.15));
    animation: float 6s ease-in-out infinite;
}

.floating-card {
    position: absolute;
    display: flex;
    align-items: center;
    background: white;
    border-radius: 12px;
    padding: 10px 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    z-index: 4;
    animation: float 5s ease-in-out infinite;
}

.floating-card-1 {
    top: 15%;
    left: 0;
    animation-delay: 0.5s;
}

.floating-card-2 {
    top: 45%;
    right: 0;
    animation-delay: 1s;
}

.floating-card-3 {
    bottom: 15%;
    left: 10%;
    animation-delay: 1.5s;
}

.floating-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 12px;
}

.floating-text {
    font-size: 0.9rem;
}

.wave-divider {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    z-index: 5;
}

.wave-divider svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 80px;
}

.wave-divider .shape-fill {
    fill: #FFFFFF;
}

.animated-shapes .shape {
    position: absolute;
    border-radius: 50%;
    z-index: 1;
    opacity: 0.2;
    animation: float 8s ease-in-out infinite;
}

.animated-shapes .shape-1 {
    width: 150px;
    height: 150px;
    top: 15%;
    left: 10%;
    background-color: var(--bs-primary);
    animation-delay: 0s;
}

.animated-shapes .shape-2 {
    width: 80px;
    height: 80px;
    top: 60%;
    left: 20%;
    background-color: var(--bs-success);
    animation-delay: 1s;
}

.animated-shapes .shape-3 {
    width: 120px;
    height: 120px;
    top: 25%;
    right: 15%;
    background-color: var(--bs-warning);
    animation-delay: 2s;
}

.animated-shapes .shape-4 {
    width: 100px;
    height: 100px;
    bottom: 15%;
    right: 10%;
    background-color: var(--bs-danger);
    animation-delay: 3s;
}

.animated-shapes .shape-5 {
    width: 70px;
    height: 70px;
    bottom: 30%;
    left: 30%;
    background-color: var(--bs-info);
    animation-delay: 4s;
}

.animated-shapes .shape-6 {
    width: 90px;
    height: 90px;
    top: 40%;
    right: 30%;
    background-color: var(--bs-secondary);
    animation-delay: 5s;
    }
    
    @keyframes float {
        0% {
        transform: translateY(0);
        }
        50% {
        transform: translateY(-15px);
        }
        100% {
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.scroll-down-indicator {
    position: absolute;
    bottom: 90px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 20;
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    animation: fadeInUp 1s ease-out 1.5s;
    animation-fill-mode: both;
}

.mouse {
    width: 30px;
    height: 50px;
    border: 2px solid rgba(255,255,255,0.8);
    border-radius: 20px;
        position: relative;
}

.wheel {
    position: absolute;
    width: 6px;
    height: 10px;
    background-color: #fff;
    left: 50%;
    top: 10px;
    transform: translateX(-50%);
    border-radius: 3px;
    animation: wheel 1.5s infinite;
}

.arrows {
    margin-top: 10px;
}

.arrow-down {
    display: block;
    width: 15px;
    height: 15px;
    border-right: 2px solid rgba(255,255,255,0.8);
    border-bottom: 2px solid rgba(255,255,255,0.8);
    transform: rotate(45deg);
    margin: -5px;
    animation: arrow 1.5s infinite;
}

.arrow-down:nth-child(2) {
    animation-delay: 0.2s;
}

.stats-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.hero-stats {
    border-top: 1px solid rgba(255,255,255,0.1);
}

/* Section Styles */
.section-heading {
    margin-bottom: 3rem;
}

.subtitle {
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--bs-primary);
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.title-gradient {
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-info) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-fill-color: transparent;
}

.section-separator {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1.5rem;
}

.section-separator span {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: var(--bs-primary);
    margin: 0 5px;
}

.section-separator span:nth-child(2) {
    width: 25px;
    border-radius: 10px;
}

/* Feature Cards */
.feature-card {
    transition: all 0.4s ease;
        overflow: hidden;
    border-radius: 15px;
}

.feature-card:hover {
            transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
}

.icon-wrapper {
    position: relative;
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-bg {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    opacity: 0.15;
    transition: all 0.4s ease;
}

.feature-icon {
    font-size: 2.2rem;
    position: relative;
    z-index: 1;
}

.feature-card:hover .icon-bg {
    transform: scale(1.2);
    opacity: 0.25;
}

.hover-reveal {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
}

.feature-card:hover .hover-reveal {
    opacity: 1;
    transform: translateY(0);
}

/* Course Cards */
.course-card {
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.4s ease;
}

.course-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
}

.card-image-wrapper {
        position: relative;
        overflow: hidden;
    height: 200px;
}

.card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.8s ease;
}

.course-card:hover .card-img-top {
    transform: scale(1.1);
}

.card-badges {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 10;
}

.card-badges .badge {
    margin-right: 5px;
    font-size: 0.7rem;
    padding: 6px 10px;
    border-radius: 20px;
}

.card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.4s ease;
}

.course-card:hover .card-overlay {
    opacity: 1;
}

.instructor-avatar {
    width: 30px;
    height: 30px;
    object-fit: cover;
}

.rating {
    color: #ffc107;
    font-weight: 600;
    font-size: 0.85rem;
}

.course-meta {
    color: var(--bs-gray-600);
    font-size: 0.85rem;
}

/* Testimonial Cards */
.testimonial-slider {
    position: relative;
    padding: 0 30px;
}

.testimonial-card {
    position: relative;
    padding: 2rem;
    border-radius: 15px;
    background-color: #fff;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.4s ease;
        height: 100%;
}

.testimonial-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.quote-icon {
    position: absolute;
    top: -15px;
    right: 30px;
    width: 40px;
    height: 40px;
    background-color: var(--bs-primary);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.testimonial-rating {
    color: #ffc107;
}

.testimonial-text {
    font-style: italic;
    margin-bottom: 1.5rem;
}

.testimonial-author {
    display: flex;
    align-items: center;
}

.testimonial-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
        object-fit: cover;
    margin-right: 15px;
}

.testimonial-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 2rem;
}

.testimonial-arrow {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid #e5e5e5;
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.testimonial-arrow:hover {
    background-color: var(--bs-primary);
    color: #fff;
    border-color: var(--bs-primary);
}

.testimonial-pagination {
    display: flex;
    align-items: center;
    margin: 0 15px;
}

/* CTA Section */
.cta-section {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
}

.cta-bg-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    background: url("{{ asset('images/cta-bg.jpg') }}") center/cover no-repeat;
    z-index: 0;
}

.cta-bg-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.95) 0%, rgba(var(--bs-info-rgb), 0.9) 100%);
    z-index: 1;
}

.cta-floating-elements .floating-element {
    position: absolute;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255, 255, 255, 0.7);
}

.floating-element.el-1 {
    width: 60px;
    height: 60px;
    top: 20%;
    left: 10%;
    font-size: 1.5rem;
}

.floating-element.el-2 {
    width: 80px;
    height: 80px;
    bottom: 15%;
    left: 20%;
    font-size: 2rem;
}

.floating-element.el-3 {
    width: 70px;
    height: 70px;
    top: 30%;
    right: 15%;
    font-size: 1.8rem;
}

.floating-element.el-4 {
    width: 50px;
    height: 50px;
    bottom: 25%;
    right: 10%;
    font-size: 1.3rem;
}

/* Blog Cards */
.blog-card {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
    background-color: #fff;
    transition: all 0.4s ease;
}

.blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.blog-card-image {
        position: relative;
    height: 200px;
    overflow: hidden;
}

.blog-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    transition: all 0.8s ease;
}

.blog-card:hover .blog-card-image img {
    transform: scale(1.1);
}

.blog-date {
    position: absolute;
    bottom: 15px;
    right: 15px;
    background-color: var(--bs-primary);
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    line-height: 1;
}

.blog-date .day {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
}

.blog-date .month {
    display: block;
    font-size: 0.8rem;
    margin-top: 3px;
}

.blog-card-content {
    padding: 1.5rem;
}

.blog-card-category {
    margin-bottom: 10px;
    color: var(--bs-primary);
    font-size: 0.9rem;
}

.blog-card-title {
    font-size: 1.25rem;
    margin-bottom: 15px;
    font-weight: 600;
    line-height: 1.4;
}

.blog-card-excerpt {
    color: var(--bs-gray-600);
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.blog-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #eee;
    padding-top: 15px;
}

.blog-author {
    display: flex;
    align-items: center;
}

.author-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
}

.blog-read-more {
    color: var(--bs-primary);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-read-more:hover {
    color: var(--bs-primary-dark);
}

/* Stats Section */
.stat-card {
    padding: 2rem;
    border-radius: 15px;
    background-color: #fff;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.4s ease;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background-color: rgba(var(--bs-primary-rgb), 0.1);
    color: var(--bs-primary);
    border-radius: 50%;
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--bs-primary);
}

.stat-title {
    font-size: 1.1rem;
    color: var(--bs-gray-600);
}

/* Button Effects */
.shine-effect {
    position: relative;
    overflow: hidden;
}

.shine-effect::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 100%);
    transform: skewX(-25deg);
    transition: all 0.75s ease;
}

.shine-effect:hover::after {
    left: 125%;
}

.btn-hover-slide {
    position: relative;
    overflow: hidden;
    z-index: 1;
    transition: all 0.5s ease;
}

.btn-hover-slide::before {
    content: '';
        position: absolute;
        top: 0;
        left: 0;
    width: 0%;
    height: 100%;
    background-color: #fff;
    transition: all 0.5s ease;
    z-index: -1;
}

.btn-hover-slide:hover {
    color: var(--bs-primary);
}

.btn-hover-slide:hover::before {
        width: 100%;
}

/* Animations */
@keyframes wheel {
    0% {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
    100% {
        opacity: 0;
        transform: translateX(-50%) translateY(20px);
    }
}

@keyframes arrow {
    0% {
        opacity: 0;
        transform: rotate(45deg) translate(-5px, -5px);
    }
    50% {
        opacity: 1;
    }
    100% {
        opacity: 0;
        transform: rotate(45deg) translate(5px, 5px);
    }
}

@media (max-width: 991.98px) {
    .hero-section {
        min-height: auto;
    }
    
    .min-vh-75 {
        min-height: auto;
    }
    
    .animated-shapes .shape {
        display: none;
    }
    
    .cta-floating-elements .floating-element {
        display: none;
    }
}

/* Roadmap Section */
.roadmap-container {
    position: relative;
    padding: 40px 0;
    overflow: hidden;
    margin-top: 30px;
}

.roadmap-line {
    position: absolute;
    top: 50%;
    left: 5%;
    right: 5%;
    height: 4px;
    background: linear-gradient(90deg, var(--bs-primary), var(--bs-info));
    transform: translateY(-50%) scaleX(0);
    transform-origin: left center;
    transition: transform 1.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 1;
    border-radius: 4px;
}

.roadmap-line.is-visible {
    transform: translateY(-50%) scaleX(1);
}

.roadmap-item {
    position: relative;
    padding: 20px 10px;
    z-index: 2;
    text-align: center;
    opacity: 0;
    transform: translateY(50px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.roadmap-item.is-visible {
    opacity: 1;
    transform: translateY(0);
}

.roadmap-point {
    position: absolute;
    top: 0;
    left: 50%;
    width: 20px;
    height: 20px;
    background-color: #fff;
    border: 4px solid var(--bs-primary);
    border-radius: 50%;
    transform: translate(-50%, -10px) scale(0);
    z-index: 3;
    transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.3s, 
                background-color 0.3s ease;
    box-shadow: 0 0 0 0 rgba(var(--bs-primary-rgb), 0.2);
}

.roadmap-point.is-visible {
    transform: translate(-50%, -10px) scale(1);
    box-shadow: 0 0 0 6px rgba(var(--bs-primary-rgb), 0.2);
}

.roadmap-item.active .roadmap-point {
    background-color: var(--bs-primary);
}

.roadmap-item:hover .roadmap-point {
    background-color: var(--bs-primary);
    transform: translate(-50%, -10px) scale(1.2);
    box-shadow: 0 0 0 8px rgba(var(--bs-primary-rgb), 0.2);
}

.roadmap-content {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
    padding: 30px 20px;
    text-align: center;
        height: 100%;
    position: relative;
    margin-top: 30px;
    transform: translateY(30px);
    opacity: 0;
    transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.5s,
                opacity 0.6s ease 0.5s,
                box-shadow 0.3s ease,
                transform 0.3s ease;
}

.roadmap-content.is-visible {
    transform: translateY(0);
    opacity: 1;
}

.roadmap-item:hover .roadmap-content {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.roadmap-icon {
    width: 70px;
    height: 70px;
    background-color: rgba(var(--bs-primary-rgb), 0.1);
    color: var(--bs-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 20px;
    transform: rotate(-180deg) scale(0);
    opacity: 0;
    transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.7s,
                opacity 0.6s ease 0.7s,
                background-color 0.3s ease,
                color 0.3s ease;
}

.roadmap-icon.is-visible {
    transform: rotate(0) scale(1);
    opacity: 1;
}

.roadmap-item:hover .roadmap-icon {
    background-color: var(--bs-primary);
    color: #fff;
    transform: rotateY(180deg) scale(1);
}

.roadmap-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    transform: translateY(20px);
    opacity: 0;
    transition: transform 0.5s ease 0.9s,
                opacity 0.5s ease 0.9s;
}

.roadmap-title.is-visible {
    transform: translateY(0);
    opacity: 1;
}

.roadmap-text {
    color: var(--bs-gray-600);
    font-size: 0.9rem;
    margin-bottom: 15px;
    transform: translateY(20px);
    opacity: 0;
    transition: transform 0.5s ease 1.1s,
                opacity 0.5s ease 1.1s;
}

.roadmap-text.is-visible {
    transform: translateY(0);
    opacity: 1;
}

.roadmap-btn {
    opacity: 0;
    transform: translateY(20px);
    transition: transform 0.5s ease 1.3s,
                opacity 0.5s ease 1.3s,
                background-color 0.3s ease,
                color 0.3s ease;
}

.roadmap-btn.is-visible {
    opacity: 1;
    transform: translateY(0);
}

/* Technology Stack Section */
.tech-stack-section {
    padding: 50px 0;
    background-color: #f8f9fa;
    border-radius: 20px;
    overflow: hidden;
}

.tech-slider {
        position: relative;
    padding: 30px 0;
    overflow: hidden;
    margin: 0 -20px;
}

.tech-track {
    display: flex;
    width: fit-content;
    animation: scroll 30s linear infinite;
}

.tech-slide {
    width: 150px;
    margin: 0 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.tech-slide img {
    max-width: 100%;
    max-height: 80px;
    object-fit: contain;
    filter: grayscale(100%);
    opacity: 0.6;
    transition: all 0.4s ease;
}

.tech-slide:hover img {
    filter: grayscale(0%);
    opacity: 1;
    transform: scale(1.1);
}

@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

/* Why Choose Section */
.why-choose-section {
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.why-choose-card {
    display: flex;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
    padding: 30px;
    transition: all 0.4s ease;
    height: 100%;
    overflow: hidden;
    position: relative;
}

.why-choose-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 5px;
    height: 0;
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-info) 100%);
    transition: all 0.4s ease;
}

.why-choose-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.why-choose-card:hover::before {
    height: 100%;
}

.why-choose-icon {
    margin-right: 20px;
    flex-shrink: 0;
}

.icon-circle {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background-color: rgba(var(--bs-primary-rgb), 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--bs-primary);
    transition: all 0.4s ease;
}

.why-choose-card:hover .icon-circle {
    background-color: var(--bs-primary);
    color: #fff;
    transform: rotateY(180deg);
}

.why-choose-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 12px;
    transition: all 0.3s ease;
}

.why-choose-card:hover .why-choose-title {
    color: var(--bs-primary);
}

.why-choose-text {
    color: var(--bs-gray-600);
    margin-bottom: 0;
    line-height: 1.6;
}

@media (max-width: 767.98px) {
    .why-choose-card {
        flex-direction: column;
        text-align: center;
    }
    
    .why-choose-icon {
        margin-right: 0;
        margin-bottom: 20px;
    }
    
    .icon-circle {
        margin: 0 auto;
    }
    }

/* Category Cards */
.category-wrapper {
    position: relative;
    margin-bottom: 30px;
}

.categories-slider {
    margin-bottom: 30px;
}

.category-card {
    border-radius: 15px;
    transition: all 0.4s ease;
    overflow: hidden;
    position: relative;
    min-height: 180px;
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
}

.category-icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(255, 255, 255, 0.5);
    transition: all 0.4s ease;
}

.category-icon {
    font-size: 2rem;
    transition: all 0.4s ease;
}

.category-card:hover .category-icon-wrapper {
    transform: rotateY(180deg);
}

.category-card:hover .category-icon {
    transform: rotateY(180deg);
}

.category-card-link {
    display: block;
    height: 100%;
}

/* Khóa học yêu thích - Thiết kế mới */
.popular-courses-container {
    position: relative;
    margin-bottom: 30px;
}

.course-card-wrapper {
    position: relative;
}

.course-card-featured {
    margin-bottom: 30px;
}

.course-card-large {
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.shadow-hover {
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.shadow-hover:hover {
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    transform: translateY(-5px);
}

.course-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 16px 0 0 16px;
}

.object-cover {
    object-fit: cover;
}

.course-overlay-gradient {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);
    z-index: 1;
}

.course-featured-badge {
    position: absolute;
    top: 20px;
    left: 20px;
        z-index: 2;
}

.course-featured-badge .badge {
    font-size: 0.8rem;
    padding: 8px 15px;
    border-radius: 30px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.course-rating i {
    font-size: 0.85rem;
}

.course-card-modern {
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.course-card-modern:hover {
    transform: translateY(-10px);
}

.course-image-wrapper {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.course-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
        height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%);
    opacity: 0;
    transition: all 0.4s ease;
        display: flex;
        align-items: center;
    justify-content: center;
    z-index: 1;
}

.course-card-modern:hover .course-image-overlay {
    opacity: 1;
}

.course-badge-wrapper {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 2;
}

.btn-view-course {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    color: var(--bs-primary);
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 30px;
    opacity: 0;
    transition: all 0.5s ease;
    transform: translate(-50%, -50%) scale(0.8);
    text-decoration: none;
    z-index: 3;
    white-space: nowrap;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.btn-view-course span {
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-view-course i {
    display: inline-block;
    margin-left: 5px;
    transition: all 0.3s ease;
}

.course-card-modern:hover .btn-view-course {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

.btn-view-course:hover {
    background-color: var(--bs-primary);
    color: #fff;
}

.btn-view-course:hover span {
    transform: translateX(-3px);
}

.btn-view-course:hover i {
    transform: translateX(3px);
}

.course-grid {
    position: relative;
}

@media (max-width: 767.98px) {
    .course-card-large .row {
        flex-direction: column;
    }
    
    .course-image-container {
        height: 200px;
        border-radius: 16px 16px 0 0;
    }
    }

/* CSS để ẩn các phần tử ban đầu */
.reveal-section {
    opacity: 0;
    visibility: hidden;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease, visibility 0.6s ease;
}

.reveal-section.is-visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.feature-card, .category-card, .course-card-large, .course-card-modern, 
.roadmap-content, .roadmap-point, .roadmap-line, .roadmap-icon,
.why-choose-card, .blog-card, .stat-card, .tech-slide,
.cta-title, .cta-text, .cta-buttons > *, .floating-element {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.feature-card.is-visible, .category-card.is-visible, .course-card-large.is-visible, 
.course-card-modern.is-visible, .roadmap-content.is-visible, .roadmap-point.is-visible, 
.roadmap-line.is-visible, .roadmap-icon.is-visible, .why-choose-card.is-visible, 
.blog-card.is-visible, .stat-card.is-visible, .tech-slide.is-visible,
.cta-title.is-visible, .cta-text.is-visible, .cta-buttons > *.is-visible, 
.floating-element.is-visible {
    opacity: 1;
    transform: translateY(0);
}

.roadmap-line {
    transform-origin: left center;
    transform: scaleX(0);
    transition: transform 1.5s ease;
}

.roadmap-line.is-visible {
    transform: scaleX(1);
}

.course-badge-wrapper, .course-featured-badge {
    opacity: 0;
    transform: scale(0);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.course-badge-wrapper.is-visible, .course-featured-badge.is-visible {
    opacity: 1;
    transform: scale(1);
    }
</style>

@endsection

@section('scripts')
<!-- GSAP Animation Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
<!-- Particles.js -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Register GSAP plugins
        gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
        
        // Lưu trữ các phần tử đã hiển thị hiệu ứng
        const animatedElements = new Set();
        
        // Khởi tạo Particles.js nếu thư viện đã được tải
        if(document.getElementById('particles-js') && typeof particlesJS !== 'undefined') {
            try {
                particlesJS('particles-js', {
                    "particles": {
                        "number": {
                            "value": 80,
                            "density": {
                                "enable": true,
                                "value_area": 800
                            }
                        },
                        "color": {
                            "value": "#ffffff"
                        },
                        "shape": {
                            "type": "circle",
                            "stroke": {
                                "width": 0,
                                "color": "#000000"
                            },
                        },
                        "opacity": {
                            "value": 0.3,
                            "random": true,
                            "anim": {
                                "enable": true,
                                "speed": 1,
                                "opacity_min": 0.1,
                                "sync": false
                            }
                        },
                        "size": {
                            "value": 3,
                            "random": true,
                            "anim": {
                                "enable": true,
                                "speed": 2,
                                "size_min": 0.1,
                                "sync": false
                            }
                        },
                        "line_linked": {
                            "enable": true,
                            "distance": 150,
                            "color": "#ffffff",
                            "opacity": 0.2,
                            "width": 1
                        },
                        "move": {
                            "enable": true,
                            "speed": 1,
                            "direction": "none",
                            "random": true,
                            "straight": false,
                            "out_mode": "out",
                            "bounce": false,
                        }
                    },
                    "interactivity": {
                        "detect_on": "canvas",
                        "events": {
                            "onhover": {
                                "enable": true,
                                "mode": "grab"
                            },
                            "onclick": {
                                "enable": true,
                                "mode": "push"
                            },
                            "resize": true
                        },
                        "modes": {
                            "grab": {
                                "distance": 140,
                                "line_linked": {
                                    "opacity": 0.5
                                }
                            },
                            "push": {
                                "particles_nb": 3
                            }
                        }
                    },
                    "retina_detect": true
                });
            } catch(e) {
                console.warn('ParticlesJS initialization failed:', e);
            }
        } else {
            console.warn('ParticlesJS not available or particles-js element not found');
        }
        
        // Đảm bảo ScrollTrigger được khởi tạo đúng cách
        ScrollTrigger.matchMedia({
            "(min-width: 1px)": function() {
                // Xóa các ScrollTrigger cũ để tránh xung đột
                ScrollTrigger.getAll().forEach(trigger => trigger.kill());
                
                console.log("Initializing animations");
                
                // Hero Section - không áp dụng scroll reveal
                initHeroAnimations();
                
                // Thiết lập các hiệu ứng cuộn cho từng phần
                setupRevealSections();
                setupFeatureCardsAnimation();
                setupCategoryCardsAnimation();
                setupFeaturedCourseAnimation();
                setupCourseGridAnimation();
                setupRoadmapAnimation();
                setupWhyChooseAnimation();
                setupTechStackAnimation();
                setupCTAAnimation();
                setupBlogCardsAnimation();
                setupStatsAnimation();
                
                // Khởi tạo hover effects
                initHoverEffects();
            }
        });
        
        function initHeroAnimations() {
            // Smooth scroll khi click vào scroll indicator
            const scrollIndicator = document.querySelector('.scroll-down-indicator');
            if (scrollIndicator) {
                scrollIndicator.addEventListener('click', function() {
                    gsap.to(window, {
                        duration: 1, 
                        scrollTo: {y: window.innerHeight, autoKill: false},
                        ease: 'power2.inOut'
                    });
                });
            }
            
            // Parallax effect cho hero background
            const heroSection = document.querySelector('.hero-section');
            const heroBackground = document.querySelector('.hero-bg');
            
            if (heroSection && heroBackground) {
                gsap.to(heroBackground, {
                    yPercent: 20,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: heroSection,
                        start: 'top top',
                        end: 'bottom top',
                        scrub: 0.5
                    }
                });
            }
            
            // Parallax effect cho floating cards
            const floatingElements = [
                { element: '.floating-card-1', y: -50, scrub: 0.5 },
                { element: '.floating-card-2', y: -80, scrub: 0.7 },
                { element: '.floating-card-3', y: -30, scrub: 0.3 }
            ];
            
            floatingElements.forEach(item => {
                const element = document.querySelector(item.element);
                if (element && heroSection) {
                    gsap.to(element, {
                        y: item.y,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: heroSection,
                            start: 'top top',
                            end: 'bottom top',
                            scrub: item.scrub
                        }
                    });
                }
            });
            
            // Parallax effect cho các shape
            const shapes = document.querySelectorAll('.animated-shapes .shape');
            shapes.forEach((shape, index) => {
                if (shape && heroSection) {
                    gsap.to(shape, {
                        y: -30 - (index * 10),
                        ease: 'none',
                        scrollTrigger: {
                            trigger: heroSection,
                            start: 'top top',
                            end: 'bottom top',
                            scrub: 0.5 + (index * 0.1)
                        }
                    });
                }
            });
        }
        
        function setupRevealSections() {
            // Thiết lập hiệu ứng cho các section
            document.querySelectorAll('.reveal-section').forEach(section => {
                ScrollTrigger.create({
                    trigger: section,
                    start: 'top 80%',
                    once: true,
                    onEnter: () => {
                        section.classList.add('is-visible');
                    }
                });
            });
        }
        
        function setupFeatureCardsAnimation() {
            // Hiệu ứng cho "Tại sao chọn LearnHub?"
            ScrollTrigger.create({
                trigger: '.features-cards',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('features-cards')) {
                        document.querySelectorAll('.feature-card').forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('is-visible');
                            }, index * 200);
                        });
                        console.log('Feature cards animation triggered');
                        animatedElements.add('features-cards');
                    }
                }
            });
        }
        
        function setupCategoryCardsAnimation() {
            // Hiệu ứng cho danh mục khóa học
            ScrollTrigger.create({
                trigger: '.categories-slider',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('categories-slider')) {
                        document.querySelectorAll('.category-card').forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('is-visible');
                            }, index * 100);
                        });
                        console.log('Category cards animation triggered');
                        animatedElements.add('categories-slider');
                    }
                }
            });
        }
        
        function setupFeaturedCourseAnimation() {
            // Hiệu ứng cho khóa học nổi bật
            ScrollTrigger.create({
                trigger: '.course-card-featured',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('course-card-featured')) {
                        // Hiệu ứng theo thứ tự
                        const cardLarge = document.querySelector('.course-card-large');
                        const badge = document.querySelector('.course-featured-badge');
                        const rating = document.querySelector('.course-card-large .course-rating');
                        const title = document.querySelector('.course-card-large .card-title');
                        const text = document.querySelector('.course-card-large .card-text');
                        const stats = document.querySelectorAll('.course-card-large .course-stats > *');
                        const price = document.querySelector('.course-card-large .course-price');
                        const button = document.querySelector('.course-card-large .btn-primary');
                        
                        setTimeout(() => cardLarge.classList.add('is-visible'), 0);
                        setTimeout(() => badge.classList.add('is-visible'), 400);
                        setTimeout(() => rating.classList.add('is-visible'), 500);
                        setTimeout(() => title.classList.add('is-visible'), 600);
                        setTimeout(() => text.classList.add('is-visible'), 700);
                        
                        stats.forEach((item, index) => {
                            setTimeout(() => item.classList.add('is-visible'), 800 + (index * 100));
                        });
                        
                        setTimeout(() => price.classList.add('is-visible'), 1000);
                        setTimeout(() => button.classList.add('is-visible'), 1100);
                        
                        console.log('Featured course animation triggered');
                        animatedElements.add('course-card-featured');
                    }
                }
            });
        }
        
        function setupCourseGridAnimation() {
            // Hiệu ứng cho grid khóa học
            ScrollTrigger.create({
                trigger: '.course-grid',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('course-grid')) {
                        document.querySelectorAll('.course-card-modern').forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('is-visible');
                            }, index * 200);
                        });
                        
                        document.querySelectorAll('.course-badge-wrapper').forEach((badge, index) => {
                            setTimeout(() => {
                                badge.classList.add('is-visible');
                            }, 300 + (index * 200));
                        });
                        
                        console.log('Course grid animation triggered');
                        animatedElements.add('course-grid');
                    }
                }
            });
        }
        
        function setupRoadmapAnimation() {
            // Hiệu ứng cho lộ trình học tập
            ScrollTrigger.create({
                trigger: '.roadmap-container',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('roadmap-container')) {
                        // Thêm class is-visible cho đường line trước
                        const line = document.querySelector('.roadmap-line');
                        line.classList.add('is-visible');
                        
                        // Sau đó hiển thị từng phần tử theo thứ tự
                        const items = document.querySelectorAll('.roadmap-item');
                        const points = document.querySelectorAll('.roadmap-point');
                        const contents = document.querySelectorAll('.roadmap-content');
                        const icons = document.querySelectorAll('.roadmap-icon');
                        const titles = document.querySelectorAll('.roadmap-title');
                        const texts = document.querySelectorAll('.roadmap-text');
                        const buttons = document.querySelectorAll('.roadmap-btn');
                        
                        // Hiển thị các item theo thứ tự
                        items.forEach((item, index) => {
                            setTimeout(() => {
                                item.classList.add('is-visible');
                            }, 400 + (index * 200));
                        });
                        
                        // Hiển thị các điểm
                        points.forEach((point, index) => {
                            setTimeout(() => {
                                point.classList.add('is-visible');
                            }, 600 + (index * 200));
                        });
                        
                        // Hiển thị nội dung
                        contents.forEach((content, index) => {
                            setTimeout(() => {
                                content.classList.add('is-visible');
                            }, 800 + (index * 200));
                        });
                        
                        // Hiển thị icon
                        icons.forEach((icon, index) => {
                            setTimeout(() => {
                                icon.classList.add('is-visible');
                            }, 1000 + (index * 200));
                        });
                        
                        // Hiển thị tiêu đề
                        titles.forEach((title, index) => {
                            setTimeout(() => {
                                title.classList.add('is-visible');
                            }, 1200 + (index * 200));
                        });
                        
                        // Hiển thị đoạn văn
                        texts.forEach((text, index) => {
                            setTimeout(() => {
                                text.classList.add('is-visible');
                            }, 1400 + (index * 200));
                        });
                        
                        // Hiển thị nút
                        buttons.forEach((button, index) => {
                            setTimeout(() => {
                                button.classList.add('is-visible');
                            }, 1600 + (index * 200));
                        });
                        
                        console.log('Roadmap animation triggered');
                        animatedElements.add('roadmap-container');
                    }
                }
            });
        }
        
        function setupWhyChooseAnimation() {
            // Hiệu ứng cho phần "Tại sao chọn LearnHub" (phần thứ hai)
            ScrollTrigger.create({
                trigger: '.why-choose-section',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('why-choose-section')) {
                        document.querySelectorAll('.why-choose-card').forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('is-visible');
                            }, index * 200);
                        });
                        console.log('Why choose animation triggered');
                        animatedElements.add('why-choose-section');
                    }
                }
            });
        }
        
        function setupTechStackAnimation() {
            // Hiệu ứng cho phần công nghệ
            ScrollTrigger.create({
                trigger: '.tech-stack-section',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('tech-stack-section')) {
                        document.querySelectorAll('.tech-slide').forEach((slide, index) => {
                            setTimeout(() => {
                                slide.classList.add('is-visible');
                            }, index * 50);
                        });
                        console.log('Tech stack animation triggered');
                        animatedElements.add('tech-stack-section');
                    }
                }
            });
        }
        
        function setupCTAAnimation() {
            // Hiệu ứng cho phần CTA
            ScrollTrigger.create({
                trigger: '.cta-section',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('cta-section')) {
                        const title = document.querySelector('.cta-title');
                        const text = document.querySelector('.cta-text');
                        const buttons = document.querySelectorAll('.cta-buttons > *');
                        const elements = document.querySelectorAll('.floating-element');
                        
                        setTimeout(() => title.classList.add('is-visible'), 0);
                        setTimeout(() => text.classList.add('is-visible'), 300);
                        
                        buttons.forEach((button, index) => {
                            setTimeout(() => button.classList.add('is-visible'), 600 + (index * 200));
                        });
                        
                        elements.forEach((element, index) => {
                            setTimeout(() => element.classList.add('is-visible'), 800 + (index * 200));
                        });
                        
                        console.log('CTA animation triggered');
                        animatedElements.add('cta-section');
                    }
                }
            });
        }
        
        function setupBlogCardsAnimation() {
            // Hiệu ứng cho blog cards
            ScrollTrigger.create({
                trigger: '.blog-cards',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('blog-cards')) {
                        document.querySelectorAll('.blog-card').forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('is-visible');
                            }, index * 200);
                        });
                        console.log('Blog cards animation triggered');
                        animatedElements.add('blog-cards');
                    }
                }
            });
        }
        
        function setupStatsAnimation() {
            // Hiệu ứng cho stats section
            ScrollTrigger.create({
                trigger: '.stats-section',
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    if (!animatedElements.has('stats-section')) {
                        document.querySelectorAll('.stat-card').forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('is-visible');
                            }, index * 200);
                        });
                        
                        // Animate counters
                        const counterUp = document.querySelectorAll('.counter-up');
                        counterUp.forEach(counter => {
                            const target = parseInt(counter.getAttribute('data-target'));
                            let count = 0;
                            const duration = 2000; // 2 seconds
                            const increment = target / (duration / 16); // 60fps
                            
                            const animateCounter = () => {
                                count += increment;
                                if (count < target) {
                                    counter.innerHTML = Math.round(count);
                                    requestAnimationFrame(animateCounter);
                                } else {
                                    counter.innerHTML = target;
                                }
                            };
                            
                            animateCounter();
                        });
                        
                        console.log('Stats animation triggered');
                        animatedElements.add('stats-section');
                    }
                }
            });
        }
        
        function initHoverEffects() {
            // Hover effects đã được thiết lập bằng CSS
            console.log("Hover effects initialized");
        }
    });
</script>
@endsection
