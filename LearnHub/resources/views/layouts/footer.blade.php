<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-book fs-3 me-2"></i>
                    <span class="fs-4 fw-bold">LearnHub</span>
                </div>
                <p class="text-light mb-4">
                    Nền tảng học tập trực tuyến hiện đại giúp bạn tiếp cận kiến thức mọi lúc, mọi nơi.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-decoration-none text-white">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>
                    <a href="#" class="text-decoration-none text-white">
                        <i class="bi bi-twitter-x fs-5"></i>
                    </a>
                    <a href="instagram.com" class="text-decoration-none text-white">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="mb-3">Liên kết nhanh</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-decoration-none text-light">Trang chủ</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('courses.index') }}" class="text-decoration-none text-light">Khóa học</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('about') }}" class="text-decoration-none text-light">Giới thiệu</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('contact') }}" class="text-decoration-none text-light">Liên hệ</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="mb-3">Danh mục khóa học</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('courses.category', 'programming') }}" class="text-decoration-none text-light">Lập trình</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('courses.category', 'design') }}" class="text-decoration-none text-light">Thiết kế</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('courses.category', 'business') }}" class="text-decoration-none text-light">Kinh doanh</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('courses.category', 'language') }}" class="text-decoration-none text-light">Ngoại ngữ</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="mb-3">Liên hệ</h5>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex">
                        <i class="bi bi-geo-alt text-light me-2"></i>
                        <span class="text-light">123 Đường XXX, Quận X, TP.Hồ Chí Minh</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="bi bi-telephone text-light me-2"></i>
                        <span class="text-light">+84 123 456 789</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="bi bi-envelope text-light me-2"></i>
                        <span class="text-light">contact@learnhub.vn</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-top border-secondary mt-4 pt-4 text-center text-light">
            <p>&copy; {{ date('Y') }} LearnHub. Tất cả quyền được bảo lưu.</p>
        </div>
    </div>
</footer>
