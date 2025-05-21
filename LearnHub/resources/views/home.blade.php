<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trang Chủ - Quản lý học tập trực tuyến</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">LearnHub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Chuyển đổi điều hướng">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="#">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Khóa học</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
            </ul>
        </div>
    </div>
</nav>

<header class="bg-light py-5">
    <div class="container text-center">
        <h1 class="display-4">Chào mừng đến với LearnHub</h1>
        <p class="lead">Nền tảng học tập trực tuyến chất lượng cao, dễ dàng tiếp cận mọi lúc mọi nơi.</p>
        <a href="#" class="btn btn-primary btn-lg">Xem khóa học</a>
    </div>
</header>

<section class="container my-5">
    <h2 class="mb-4">Khóa học nổi bật</h2>
    <div class="row">
        <!-- Ví dụ các khóa học -->
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Khóa học 1">
                <div class="card-body">
                    <h5 class="card-title">Lập trình PHP Laravel</h5>
                    <p class="card-text">Học cách xây dựng ứng dụng web với framework Laravel.</p>
                    <a href="#" class="btn btn-outline-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <!-- Thêm các khóa học khác -->
    </div>
</section>

<footer class="bg-primary text-white text-center py-3">
    &copy; 2025 LearnHub - Quản lý học tập trực tuyến
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
