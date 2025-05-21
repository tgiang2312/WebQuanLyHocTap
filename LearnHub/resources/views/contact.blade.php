@extends('layouts.app')

@section('title', 'Liên hệ - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="fw-bold mb-4">Liên hệ với chúng tôi</h1>
            <p class="lead">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn mọi lúc, mọi nơi</p>
        </div>
    </div>

    <div class="row g-5">
        <!-- Contact Information -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="card-body">
                    <h3 class="fw-bold mb-4">Thông tin liên hệ</h3>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 50px; height: 50px;">
                            <i class="bi bi-geo-alt text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold">Địa chỉ</h5>
                            <p class="text-muted mb-0">Tòa nhà Innovation, 123 Đường Nguyễn Huệ, Quận 1, TP. Hồ Chí Minh</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 50px; height: 50px;">
                            <i class="bi bi-envelope text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold">Email</h5>
                            <p class="text-muted mb-0">contact@learnhub.vn</p>
                            <p class="text-muted mb-0">support@learnhub.vn</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 50px; height: 50px;">
                            <i class="bi bi-telephone text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold">Điện thoại</h5>
                            <p class="text-muted mb-0">(+84) 28 3456 7890</p>
                            <p class="text-muted mb-0">Hotline: 1800 1234</p>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 50px; height: 50px;">
                            <i class="bi bi-clock text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold">Giờ làm việc</h5>
                            <p class="text-muted mb-0">Thứ 2 - Thứ 6: 8:00 - 17:30</p>
                            <p class="text-muted mb-0">Thứ 7: 8:00 - 12:00</p>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h4 class="fw-semibold mb-3">Kết nối với chúng tôi</h4>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-outline-info rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bi bi-youtube"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="btn btn-outline-success rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <div class="card-body">
                    <h3 class="fw-bold mb-4">Gửi tin nhắn cho chúng tôi</h3>
                    <p class="text-muted mb-4">Vui lòng điền đầy đủ thông tin bên dưới, chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất</p>
                    
                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="col-md-6">
                                <label for="subject" class="form-label">Chủ đề</label>
                                <select class="form-select" id="subject" name="subject" required>
                                    <option value="" selected disabled>Chọn chủ đề</option>
                                    <option value="general">Thông tin chung</option>
                                    <option value="courses">Thông tin khóa học</option>
                                    <option value="technical">Hỗ trợ kỹ thuật</option>
                                    <option value="billing">Thanh toán & Hóa đơn</option>
                                    <option value="partnership">Hợp tác</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Nội dung tin nhắn</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="privacy" name="privacy" required>
                                    <label class="form-check-label" for="privacy">
                                        Tôi đồng ý với <a href="#" class="text-decoration-none">chính sách bảo mật</a> của LearnHub
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-send me-2"></i> Gửi tin nhắn
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Map -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <h3 class="fw-bold p-4 mb-0">Vị trí của chúng tôi</h3>
                    <div class="ratio ratio-21x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4241674198073!2d106.70236481474306!3d10.780091492318766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f4a4b28425b%3A0xd2c89fc0493a25e9!2sNguy%E1%BB%85n%20Hu%E1%BB%87%20Walking%20Street!5e0!3m2!1sen!2s!4v1660051440357!5m2!1sen!2s" 
                                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- FAQ -->
    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
            <h3 class="fw-bold mb-4 text-center">Câu hỏi thường gặp</h3>
            
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item border mb-3 rounded overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Làm thế nào để đăng ký tài khoản trên LearnHub?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Để đăng ký tài khoản, bạn chỉ cần nhấp vào nút "Đăng ký" ở góc phải trên cùng của trang web, sau đó điền đầy đủ thông tin cá nhân theo yêu cầu và xác nhận email để hoàn tất quá trình đăng ký.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item border mb-3 rounded overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Làm thế nào để liên hệ với giảng viên?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Sau khi đăng ký khóa học, bạn có thể liên hệ với giảng viên thông qua hệ thống nhắn tin nội bộ của khóa học, hoặc thông qua mục bình luận trong các bài giảng. Giảng viên sẽ phản hồi trong thời gian sớm nhất.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item border mb-3 rounded overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Các phương thức thanh toán được chấp nhận?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            LearnHub chấp nhận nhiều phương thức thanh toán khác nhau bao gồm thẻ tín dụng/ghi nợ (Visa, MasterCard, JCB), chuyển khoản ngân hàng, ví điện tử (MoMo, ZaloPay, VNPay) và thanh toán qua các cửa hàng tiện lợi.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item border rounded overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            Làm thế nào để yêu cầu hoàn tiền?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Nếu bạn không hài lòng với khóa học, bạn có thể yêu cầu hoàn tiền trong vòng 7 ngày kể từ ngày đăng ký khóa học. Vui lòng liên hệ với bộ phận hỗ trợ khách hàng qua email support@learnhub.vn hoặc qua hotline 1800 1234 để được hướng dẫn cụ thể.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Simulate form submission
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Đang gửi...';
                submitBtn.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    // Create success alert
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success mt-3';
                    alertDiv.innerHTML = '<i class="bi bi-check-circle me-2"></i> Tin nhắn của bạn đã được gửi thành công! Chúng tôi sẽ phản hồi trong thời gian sớm nhất.';
                    
                    // Insert alert before form
                    form.parentNode.insertBefore(alertDiv, form);
                    
                    // Reset form
                    form.reset();
                    submitBtn.innerHTML = '<i class="bi bi-send me-2"></i> Gửi tin nhắn';
                    submitBtn.disabled = false;
                    
                    // Auto dismiss alert
                    setTimeout(() => {
                        alertDiv.classList.add('fade');
                        setTimeout(() => alertDiv.remove(), 500);
                    }, 5000);
                }, 2000);
            });
        }
    });
</script>
@endsection 