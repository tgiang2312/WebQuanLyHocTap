<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-book fs-3 me-2"></i>
                    <span class="fs-4 fw-bold">LearnHub</span>
                </div>
                <p class="text-muted mb-4">
                    Nền tảng học tập trực tuyến hiện đại giúp bạn tiếp cận kiến thức mọi lúc, mọi nơi.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-decoration-none text-white">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>
                    <a href="#" class="text-decoration-none text-white">
                        <i class="bi bi-twitter-x fs-5"></i>
                    </a>
                    <a href="#" class="text-decoration-none text-white">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="mb-3">Liên kết nhanh</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted">Trang chủ</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('courses.index') }}" class="text-decoration-none text-muted">Khóa học</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('about') }}" class="text-decoration-none text-muted">Giới thiệu</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('contact') }}" class="text-decoration-none text-muted">Liên hệ</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="mb-3">Danh mục khóa học</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('courses.category', 'programming') }}" class="text-decoration-none text-muted">Lập trình</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('courses.category', 'design') }}" class="text-decoration-none text-muted">Thiết kế</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('courses.category', 'business') }}" class="text-decoration-none text-muted">Kinh doanh</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('courses.category', 'language') }}" class="text-decoration-none text-muted">Ngoại ngữ</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="mb-3">Liên hệ</h5>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex">
                        <i class="bi bi-geo-alt text-muted me-2"></i>
                        <span class="text-muted">123 Đường Nguyễn Văn Linh, Quận 7, TP.HCM</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="bi bi-telephone text-muted me-2"></i>
                        <span class="text-muted">+84 123 456 789</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="bi bi-envelope text-muted me-2"></i>
                        <span class="text-muted">contact@learnhub.vn</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-top border-secondary mt-4 pt-4 text-center text-muted">
            <p>&copy; {{ date('Y') }} LearnHub. Tất cả quyền được bảo lưu.</p>
        </div>
    </div>
</footer>
