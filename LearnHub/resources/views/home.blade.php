@extends('layouts.app')

@section('title', 'Trang chủ - LearnHub')

@section('content')
<div class="hero-section position-relative bg-light">
    <div class="container py-5">
        <div class="row align-items-center py-5">
            <div class="col-lg-6 py-4">
                <h1 class="display-5 fw-bold mb-4">Chào mừng đến với <span class="text-primary">LearnHub</span></h1>
                <p class="lead mb-4">Nền tảng học tập trực tuyến giúp bạn phát triển kỹ năng và kiến thức một cách hiệu quả.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg">Khám phá khóa học</a>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Đăng nhập</a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="{{ asset('images/hero-image.svg') }}" alt="LearnHub" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Features section -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Tại sao chọn LearnHub?</h2>
        <p class="lead text-muted">Nền tảng cung cấp mọi thứ bạn cần để phát triển</p>
    </div>
    
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 text-center p-4">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-block mx-auto mb-4" style="width: 80px; height: 80px;">
                    <i class="bi bi-collection-play fs-1 text-primary"></i>
                </div>
                <h3 class="fw-semibold h4">Khóa học chất lượng</h3>
                <p class="text-muted">Học từ những giáo viên giàu kinh nghiệm với nội dung bài học cập nhật liên tục.</p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 text-center p-4">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 d-inline-block mx-auto mb-4" style="width: 80px; height: 80px;">
                    <i class="bi bi-people fs-1 text-success"></i>
                </div>
                <h3 class="fw-semibold h4">Cộng đồng hỗ trợ</h3>
                <p class="text-muted">Kết nối và học hỏi cùng cộng đồng học viên và giáo viên trên toàn quốc.</p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 text-center p-4">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-inline-block mx-auto mb-4" style="width: 80px; height: 80px;">
                    <i class="bi bi-clock-history fs-1 text-warning"></i>
                </div>
                <h3 class="fw-semibold h4">Học mọi lúc, mọi nơi</h3>
                <p class="text-muted">Tiếp cận bài học mọi lúc, mọi nơi trên mọi thiết bị với giao diện thân thiện.</p>
            </div>
        </div>
    </div>
    
    <!-- Popular courses section -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">Khóa học nổi bật</h2>
            <a href="{{ route('courses.index') }}" class="text-decoration-none">Xem tất cả</a>
        </div>
        
        <div class="row g-4">
            <!-- Sample course cards - In a real app, these would be populated from the database -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/course1.jpg') }}" class="card-img-top" alt="Course" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">Lập trình</span>
                        <h5 class="card-title fw-semibold">Lập trình web với Laravel</h5>
                        <p class="card-text text-muted mb-3">Học cách xây dựng website đầy đủ chức năng với Laravel Framework.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-person-circle me-2"></i>Nguyễn Văn A</span>
                            <span><i class="bi bi-clock me-2"></i>10 giờ</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="#" class="btn btn-primary w-100">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/course2.jpg') }}" class="card-img-top" alt="Course" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">Marketing</span>
                        <h5 class="card-title fw-semibold">Digital Marketing cơ bản</h5>
                        <p class="card-text text-muted mb-3">Khám phá các chiến lược marketing online hiệu quả trong thời đại số.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-person-circle me-2"></i>Trần Thị B</span>
                            <span><i class="bi bi-clock me-2"></i>8 giờ</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="#" class="btn btn-primary w-100">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/course3.jpg') }}" class="card-img-top" alt="Course" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-danger mb-2">Thiết kế</span>
                        <h5 class="card-title fw-semibold">UI/UX Design cho người mới bắt đầu</h5>
                        <p class="card-text text-muted mb-3">Học cách thiết kế giao diện người dùng thân thiện và trải nghiệm tốt.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-person-circle me-2"></i>Lê Văn C</span>
                            <span><i class="bi bi-clock me-2"></i>12 giờ</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="#" class="btn btn-primary w-100">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Testimonials section -->
    <div class="py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Học viên nói gì về chúng tôi</h2>
            <p class="lead text-muted">Trải nghiệm từ những người đã tham gia khóa học</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <div class="d-flex mb-3">
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                    <p class="mb-4">"LearnHub đã giúp tôi nâng cao kỹ năng lập trình và tìm được công việc mơ ước. Các khóa học rất chất lượng và dễ hiểu."</p>
                    <div class="d-flex align-items-center mt-auto">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/user1.jpg') }}" alt="User" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 fw-semibold">Nguyễn Văn Minh</h6>
                            <p class="text-muted small mb-0">Front-end Developer</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <div class="d-flex mb-3">
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                    <p class="mb-4">"Giáo viên rất tận tâm và luôn sẵn sàng giải đáp thắc mắc. Tôi đặc biệt thích cách trình bày bài giảng dễ hiểu và thực tế."</p>
                    <div class="d-flex align-items-center mt-auto">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/user2.jpg') }}" alt="User" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 fw-semibold">Trần Thị Hằng</h6>
                            <p class="text-muted small mb-0">UI/UX Designer</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <div class="d-flex mb-3">
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                    </div>
                    <p class="mb-4">"Tôi đã thử nhiều nền tảng học trực tuyến nhưng LearnHub là lựa chọn tốt nhất với giao diện thân thiện và nội dung chất lượng."</p>
                    <div class="d-flex align-items-center mt-auto">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/user3.jpg') }}" alt="User" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 fw-semibold">Lê Hoàng Nam</h6>
                            <p class="text-muted small mb-0">Digital Marketer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CTA section -->
    <div class="bg-primary bg-opacity-10 p-5 rounded-3 text-center my-5">
        <h2 class="fw-bold mb-3">Sẵn sàng bắt đầu hành trình học tập của bạn?</h2>
        <p class="lead mb-4">Hàng trăm khóa học đang chờ đợi bạn khám phá và làm chủ.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg px-4">Tìm khóa học ngay</a>
            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4">Đăng ký miễn phí</a>
            @endguest
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add animation to cards on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.hover-card');
        
        // Add hover effect
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('shadow');
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.classList.remove('shadow');
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Hero image floating animation
        const heroImage = document.querySelector('.hero-image');
        if (heroImage) {
            setInterval(() => {
                heroImage.classList.add('floating');
                setTimeout(() => {
                    heroImage.classList.remove('floating');
                }, 1000);
            }, 2000);
        }
    });
</script>
@endsection

@section('styles')
<style>
    .hover-card {
        transition: all 0.3s ease;
    }
    
    .floating {
        animation: float 2s ease-in-out infinite;
    }
    
    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
        100% {
            transform: translateY(0px);
        }
    }
    
    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.2);
    }
</style>
@endsection
