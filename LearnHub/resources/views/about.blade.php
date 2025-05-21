@extends('layouts.app')

@section('title', 'Giới thiệu về LearnHub')

@section('content')
<div class="container py-5">
    <!-- Hero section -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="fw-bold mb-4">Về LearnHub</h1>
            <p class="lead mb-4">Nền tảng học tập trực tuyến hàng đầu Việt Nam, kết nối giáo viên và học viên qua các khóa học chất lượng cao</p>
        </div>
    </div>
    
    <!-- About us -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <img src="{{ asset('images/about-hero.jpg') }}" alt="LearnHub Team" class="img-fluid rounded-3 shadow">
        </div>
        <div class="col-lg-6">
            <h2 class="fw-bold mb-4">Câu chuyện của chúng tôi</h2>
            <p class="mb-4">LearnHub được thành lập vào năm 2023 với sứ mệnh đưa giáo dục chất lượng cao đến tất cả mọi người, không phân biệt vị trí địa lý hay điều kiện kinh tế.</p>
            <p class="mb-4">Chúng tôi tin rằng giáo dục là chìa khóa để mở ra cơ hội và tiềm năng của mỗi người. Với LearnHub, bạn có thể học tập mọi lúc, mọi nơi, với chi phí hợp lý và nội dung được thiết kế bởi các chuyên gia hàng đầu.</p>
            <p>Ngày nay, LearnHub tự hào phục vụ hơn 50,000 học viên, cung cấp hơn 500 khóa học từ hơn 200 giảng viên có kinh nghiệm trong nhiều lĩnh vực khác nhau.</p>
        </div>
    </div>
    
    <!-- Mission and Vision -->
    <div class="row mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm h-100 p-4">
                <div class="card-body">
                    <div class="d-inline-block bg-primary bg-opacity-10 p-3 rounded-circle mb-3">
                        <i class="bi bi-lightbulb fs-2 text-primary"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Sứ mệnh</h3>
                    <p>Sứ mệnh của chúng tôi là mang đến nền giáo dục chất lượng cao, dễ tiếp cận cho mọi người, mọi lúc, mọi nơi. Chúng tôi cam kết tạo ra một nền tảng học tập trực tuyến đa dạng, nơi học viên có thể phát triển kỹ năng và kiến thức mới một cách hiệu quả.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100 p-4">
                <div class="card-body">
                    <div class="d-inline-block bg-success bg-opacity-10 p-3 rounded-circle mb-3">
                        <i class="bi bi-eye fs-2 text-success"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Tầm nhìn</h3>
                    <p>Chúng tôi hướng đến việc trở thành nền tảng học tập trực tuyến hàng đầu Việt Nam, kết nối cộng đồng học tập toàn cầu và thúc đẩy văn hóa học tập suốt đời. LearnHub cam kết sẽ luôn đổi mới và cải tiến để mang đến trải nghiệm học tập tốt nhất cho người dùng.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Our Values -->
    <div class="row mb-5">
        <div class="col-12 text-center mb-4">
            <h2 class="fw-bold">Giá trị cốt lõi</h2>
            <p class="lead">Những giá trị định hướng mọi hoạt động của chúng tôi</p>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100 text-center p-4">
                <div class="card-body">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-flex mb-3 justify-content-center align-items-center" style="width: 70px; height: 70px;">
                        <i class="bi bi-stars fs-2 text-primary"></i>
                    </div>
                    <h4 class="fw-semibold mb-3">Chất lượng</h4>
                    <p class="text-muted">Cam kết mang đến nội dung học tập chất lượng cao, được biên soạn kỹ lưỡng</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100 text-center p-4">
                <div class="card-body">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-inline-flex mb-3 justify-content-center align-items-center" style="width: 70px; height: 70px;">
                        <i class="bi bi-reception-4 fs-2 text-warning"></i>
                    </div>
                    <h4 class="fw-semibold mb-3">Đổi mới</h4>
                    <p class="text-muted">Không ngừng đổi mới phương pháp giảng dạy và công nghệ học tập</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100 text-center p-4">
                <div class="card-body">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-3 d-inline-flex mb-3 justify-content-center align-items-center" style="width: 70px; height: 70px;">
                        <i class="bi bi-heart fs-2 text-danger"></i>
                    </div>
                    <h4 class="fw-semibold mb-3">Đồng cảm</h4>
                    <p class="text-muted">Hiểu rõ nhu cầu của học viên và đặt học viên là trung tâm</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100 text-center p-4">
                <div class="card-body">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 d-inline-flex mb-3 justify-content-center align-items-center" style="width: 70px; height: 70px;">
                        <i class="bi bi-globe fs-2 text-info"></i>
                    </div>
                    <h4 class="fw-semibold mb-3">Kết nối</h4>
                    <p class="text-muted">Xây dựng cộng đồng học tập kết nối giữa giáo viên và học viên</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Our Team -->
    <div class="row mb-5">
        <div class="col-12 text-center mb-4">
            <h2 class="fw-bold">Đội ngũ sáng lập</h2>
            <p class="lead">Gặp gỡ những người đứng đằng sau LearnHub</p>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <img src="{{ asset('images/founder1.jpg') }}" class="card-img-top" alt="Founder" style="height: 250px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="fw-bold mb-1">Nguyễn Minh Tuấn</h5>
                    <p class="text-primary mb-3">Đồng sáng lập & CEO</p>
                    <p class="small text-muted">15 năm kinh nghiệm trong lĩnh vực giáo dục và công nghệ</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="text-dark"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <img src="{{ asset('images/founder2.jpg') }}" class="card-img-top" alt="Founder" style="height: 250px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="fw-bold mb-1">Trần Thu Hà</h5>
                    <p class="text-primary mb-3">Đồng sáng lập & COO</p>
                    <p class="small text-muted">Chuyên gia trong lĩnh vực quản lý giáo dục và phát triển nội dung</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="text-dark"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <img src="{{ asset('images/founder3.jpg') }}" class="card-img-top" alt="Founder" style="height: 250px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="fw-bold mb-1">Lê Văn Đức</h5>
                    <p class="text-primary mb-3">Đồng sáng lập & CTO</p>
                    <p class="small text-muted">Kỹ sư phần mềm với hơn 10 năm kinh nghiệm phát triển nền tảng học tập</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="text-dark"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <img src="{{ asset('images/founder4.jpg') }}" class="card-img-top" alt="Founder" style="height: 250px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="fw-bold mb-1">Phạm Thanh Mai</h5>
                    <p class="text-primary mb-3">Giám đốc nội dung</p>
                    <p class="small text-muted">Chuyên gia giáo dục với niềm đam mê phát triển nội dung học tập sáng tạo</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="#" class="text-dark"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contact CTA -->
    <div class="bg-primary bg-opacity-10 p-5 rounded-3 text-center mb-4">
        <h2 class="fw-bold mb-3">Liên hệ với chúng tôi</h2>
        <p class="lead mb-4">Bạn có câu hỏi hoặc đề xuất? Chúng tôi luôn sẵn sàng hỗ trợ!</p>
        <a href="mailto:contact@learnhub.vn" class="btn btn-primary btn-lg px-4 me-2">
            <i class="bi bi-envelope me-2"></i> Email
        </a>
        <a href="tel:0123456789" class="btn btn-outline-primary btn-lg px-4">
            <i class="bi bi-telephone me-2"></i> Hotline
        </a>
    </div>
</div>
@endsection 