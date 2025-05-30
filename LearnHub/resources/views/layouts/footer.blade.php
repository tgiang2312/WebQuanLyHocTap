<footer class="footer-modern position-relative overflow-hidden py-5 text-white">
    <!-- Wave shape divider -->
    <div class="footer-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 100" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="footer-wave-fill"></path>
        </svg>
    </div>
    
    <!-- Animated particles container -->
    <div class="footer-particles"></div>
    
    <!-- Main Footer Content -->
    <div class="footer-content position-relative">
    <div class="container">
            <!-- Top Footer Content -->
        <div class="row g-4">
                <div class="col-lg-4 col-md-6 footer-column">
                    <div class="footer-brand d-flex align-items-center mb-3">
                        <div class="footer-logo-circle">
                            <i class="bi bi-book"></i>
                        </div>
                        <span class="fs-4 fw-bold ms-2">LearnHub</span>
                </div>
                <p class="text-light mb-4">
                        Nền tảng học tập trực tuyến hiện đại giúp bạn tiếp cận kiến thức mọi lúc, mọi nơi với các khóa học chất lượng cao từ những chuyên gia hàng đầu.
                </p>
                    <div class="footer-social-icons">
                        <a href="#" class="social-icon" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                    </a>
                        <a href="#" class="social-icon" aria-label="Twitter">
                            <i class="bi bi-twitter-x"></i>
                    </a>
                        <a href="#" class="social-icon" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>
            
                <div class="col-lg-2 col-md-6 footer-column">
                    <h5 class="footer-title mb-4">Liên kết nhanh</h5>
                    <ul class="footer-links list-unstyled">
                        <li class="footer-link-item">
                            <a href="{{ route('home') }}" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Trang chủ</span>
                            </a>
                    </li>
                        <li class="footer-link-item">
                            <a href="{{ route('courses.index') }}" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Khóa học</span>
                            </a>
                    </li>
                        <li class="footer-link-item">
                            <a href="{{ route('about') }}" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Giới thiệu</span>
                            </a>
                    </li>
                        <li class="footer-link-item">
                            <a href="{{ route('contact') }}" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Liên hệ</span>
                            </a>
                    </li>
                </ul>
            </div>
            
                <div class="col-lg-3 col-md-6 footer-column">
                    <h5 class="footer-title mb-4">Danh mục khóa học</h5>
                    <ul class="footer-links list-unstyled">
                        <li class="footer-link-item">
                            <a href="{{ route('courses.category', 'programming') }}" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Lập trình</span>
                            </a>
                    </li>
                        <li class="footer-link-item">
                            <a href="{{ route('courses.category', 'design') }}" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Thiết kế</span>
                            </a>
                    </li>
                        <li class="footer-link-item">
                            <a href="{{ route('courses.category', 'business') }}" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Kinh doanh</span>
                            </a>
                    </li>
                        <li class="footer-link-item">
                            <a href="{{ route('courses.category', 'language') }}" class="footer-link">
                                <i class="bi bi-chevron-right"></i>
                                <span>Ngoại ngữ</span>
                            </a>
                    </li>
                </ul>
            </div>
            
                <div class="col-lg-3 col-md-6 footer-column">
                    <h5 class="footer-title mb-4">Liên hệ với chúng tôi</h5>
                    <ul class="footer-contact list-unstyled">
                        <li class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="footer-contact-text">
                                123 Đường XXX, Quận X, TP.Hồ Chí Minh
                            </div>
                        </li>
                        <li class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="footer-contact-text">
                                +84 123 456 789
                            </div>
                    </li>
                        <li class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="footer-contact-text">
                                contact@learnhub.vn
                            </div>
                    </li>
                        <li class="footer-contact-item">
                            <div class="footer-contact-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="footer-contact-text">
                                Thứ 2 - Thứ 6: 9:00 - 17:00
                            </div>
                    </li>
                </ul>
            </div>
        </div>
        
            <!-- Newsletter Subscription -->
            <div class="footer-newsletter mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="newsletter-container">
                            <div class="newsletter-content text-center">
                                <h4 class="newsletter-title">Đăng ký nhận thông tin</h4>
                                <p class="newsletter-description">Nhận thông báo về khóa học mới và ưu đãi đặc biệt</p>
                                <form class="newsletter-form d-flex">
                                    <input type="email" class="form-control" placeholder="Email của bạn" required>
                                    <button type="submit" class="btn btn-primary ms-2">Đăng ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom mt-5 pt-4 text-center">
                <div class="row">
                    <div class="col-md-6 text-md-start">
                        <p class="mb-md-0">&copy; {{ date('Y') }} LearnHub. Tất cả quyền được bảo lưu.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="footer-bottom-links">
                            <a href="#" class="footer-bottom-link">Điều khoản</a>
                            <a href="#" class="footer-bottom-link">Chính sách</a>
                            <a href="#" class="footer-bottom-link">Hỗ trợ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back to top button -->
    <button id="backToTop" class="back-to-top-btn">
        <i class="bi bi-arrow-up"></i>
    </button>
</footer>
