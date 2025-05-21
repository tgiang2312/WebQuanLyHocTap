<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nền tảng học trực tuyến LearnHubs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #8b5cf6 100%);
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .testimonial-card {
            transition: all 0.3s ease;
        }
        .testimonial-card:hover {
            transform: scale(1.03);
        }
        .nav-link:hover {
            color: #8b5cf6;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800">
    <div class="bg-gray-900 text-white py-2 px-4 text-sm">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex space-x-4">
                <a href="#" class="hover:text-purple-400"><i class="fas fa-phone-alt mr-1"></i> +1 (234) 567-8900</a>
                <a href="#" class="hover:text-purple-400"><i class="fas fa-envelope mr-1"></i> support@learnhubsonline.com</a>
            </div>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-purple-400"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-purple-400"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-purple-400"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-purple-400"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold text-purple-600 flex items-center">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    LearnHubs
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <div class="dropdown relative">
                    <button class="nav-link font-medium hover:text-purple-600 flex items-center">
                        Trang chủ <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="dropdown-menu absolute hidden bg-white shadow-lg rounded-md mt-2 py-2 w-48">
                        <a href="#" class="block px-4 py-2 hover:bg-purple-50">Trang chủ 1</a>
                        <a href="#" class="block px-4 py-2 hover:bg-purple-50">Trang chủ 2</a>
                    </div>
                </div>
                <a href="#" class="nav-link font-medium hover:text-purple-600">Khoá học</a>
                <a href="#" class="nav-link font-medium hover:text-purple-600">Trang</a>
                <a href="#" class="nav-link font-medium hover:text-purple-600">Blog</a>
                <a href="#" class="nav-link font-medium hover:text-purple-600">Liên hệ</a>
            </div>
            <div class="flex items-center space-x-4">
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <a href="#" class="hidden md:block bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">
                    Đăng ký miễn phí
                </a>
            </div>
        </div>
    </nav>
    <section class="hero-gradient text-white py-20">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">Học kỹ năng mới trực tuyến với LearnHubs</h1>
                <p class="text-lg mb-8 opacity-90">Chọn từ hơn 100.000 khoá học video trực tuyến với các khoá mới được cập nhật hàng tháng.</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#" class="bg-white text-purple-600 hover:bg-gray-100 px-6 py-3 rounded-md font-semibold text-center">Bắt đầu học ngay</a>
                    <a href="#" class="border-2 border-white hover:bg-white hover:bg-opacity-10 px-6 py-3 rounded-md font-semibold text-center">Xem tất cả khoá học</a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="https://www.learnhubsonline.com/wp-content/uploads/2023/03/hero-img-1.png" alt="Minh hoạ học tập" class="w-full max-w-md">
            </div>
        </div>
    </section>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Khám phá các danh mục hàng đầu</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Khám phá chương trình phù hợp trong các khoá học của chúng tôi. Có hàng trăm chủ đề cho bạn lựa chọn.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300 text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-laptop-code text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Lập trình</h3>
                    <p class="text-gray-500 text-sm">1.200 khoá học</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Kinh doanh</h3>
                    <p class="text-gray-500 text-sm">800 khoá học</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-camera-retro text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Nhiếp ảnh</h3>
                    <p class="text-gray-500 text-sm">450 khoá học</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-music text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Âm nhạc</h3>
                    <p class="text-gray-500 text-sm">600 khoá học</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300 text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-paint-brush text-yellow-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Thiết kế</h3>
                    <p class="text-gray-500 text-sm">1.000 khoá học</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300 text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heartbeat text-indigo-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Sức khoẻ</h3>
                    <p class="text-gray-500 text-sm">350 khoá học</p>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="#" class="inline-block border-2 border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white px-6 py-3 rounded-md font-semibold transition duration-300">
                    Xem tất cả danh mục
                </a>
            </div>
        </div>
    </section>
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Khoá học phổ biến</h2>
                    <p class="text-gray-600">Chọn từ những khoá học nổi bật nhất của chúng tôi</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="#" class="inline-block border-2 border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white px-6 py-2 rounded-md font-semibold transition duration-300">
                        Xem tất cả khoá học
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg overflow-hidden shadow-md course-card transition duration-300">
                    <div class="relative">
                        <img src="https://www.learnhubsonline.com/wp-content/uploads/2023/03/course-1.jpg" alt="Khoá học" class="w-full h-48 object-cover">
                        <div class="absolute top-3 right-3 bg-purple-600 text-white text-xs px-2 py-1 rounded">
                            Lập trình
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="flex items-center text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-gray-600 text-sm">(4.5)</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Khoá học lập trình web hoàn chỉnh 2.0</h3>
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center text-gray-500">
                                <i class="far fa-user mr-1"></i>
                                <span class="text-sm">John Smith</span>
                            </div>
                            <div class="flex items-center text-gray-500">
                                <i class="far fa-clock mr-1"></i>
                                <span class="text-sm">12 giờ</span>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
                            <span class="text-purple-600 font-bold">$89.00</span>
                            <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-md course-card transition duration-300">
                    <div class="relative">
                        <img src="https://www.learnhubsonline.com/wp-content/uploads/2023/03/course-2.jpg" alt="Khoá học" class="w-full h-48 object-cover">
                        <div class="absolute top-3 right-3 bg-blue-600 text-white text-xs px-2 py-1 rounded">
                            Kinh doanh
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="flex items-center text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="text-gray-600 text-sm">(4.0)</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Khoá học tiếp thị số toàn diện</h3>
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center text-gray-500">
                                <i class="far fa-user mr-1"></i>
                                <span class="text-sm">Sarah Johnson</span>
                            </div>
                            <div class="flex items-center text-gray-500">
                                <i class="far fa-clock mr-1"></i>
                                <span class="text-sm">15 giờ</span>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
                            <span class="text-purple-600 font-bold">$99.00</span>
                            <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-md course-card transition duration-300">
                    <div class="relative">
                        <img src="https://www.learnhubsonline.com/wp-content/uploads/2023/03/course-3.jpg" alt="Khoá học" class="w-full h-48 object-cover">
                        <div class="absolute top-3 right-3 bg-green-600 text-white text-xs px-2 py-1 rounded">
                            Nhiếp ảnh
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="flex items-center text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="text-gray-600 text-sm">(5.0)</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Khoá học nhiếp ảnh toàn diện</h3>
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center text-gray-500">
                                <i class="far fa-user mr-1"></i>
                                <span class="text-sm">Michael Brown</span>
                            </div>
                            <div class="flex items-center text-gray-500">
                                <i class="far fa-clock mr-1"></i>
                                <span class="text-sm">20 giờ</span>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
                            <span class="text-purple-600 font-bold">$79.00</span>
                            <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Vì sao chọn LearnHubs</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Chúng tôi mang đến trải nghiệm học tập tốt nhất với đội ngũ giảng viên chuyên gia và các khoá học toàn diện.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-graduation-cap text-purple-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Giảng viên chuyên gia</h3>
                    <p class="text-gray-600">Học từ các chuyên gia trong ngành, những người đam mê giảng dạy và giúp bạn thành công.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-laptop text-blue-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Truy cập trọn đời</h3>
                    <p class="text-gray-600">Truy cập trọn đời vào tất cả tài liệu khoá học, bao gồm các cập nhật và nội dung bổ sung trong tương lai.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-certificate text-green-600 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Chứng nhận</h3>
                    <p class="text-gray-600">Nhận chứng nhận sau khi hoàn thành để chứng minh kỹ năng mới với nhà tuyển dụng và đồng nghiệp.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Học viên nói gì về chúng tôi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Lắng nghe cảm nhận của học viên về trải nghiệm học tập tại LearnHubs.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-sm testimonial-card">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Học viên" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-semibold">Jennifer Lopez</h4>
                            <p class="text-gray-500 text-sm">Lập trình viên web</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Khoá học lập trình web rất đầy đủ và có cấu trúc tốt. Tôi đã tìm được việc chỉ sau hai tháng hoàn thành khoá học!"</p>
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-sm testimonial-card">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Học viên" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-semibold">Robert Johnson</h4>
                            <p class="text-gray-500 text-sm">Chuyên viên marketing số</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Khoá học marketing số vượt ngoài mong đợi của tôi. Các bài tập thực tế giúp tôi xây dựng portfolio gây ấn tượng với nhà tuyển dụng hiện tại."</p>
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-purple-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Sẵn sàng bắt đầu học?</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto opacity-90">Tham gia cùng hàng ngàn học viên đã thay đổi sự nghiệp với các khoá học của chúng tôi.</p>
            <a href="#" class="inline-block bg-white text-purple-600 hover:bg-gray-100 px-8 py-3 rounded-md font-semibold text-lg">
                Đăng ký ngay
            </a>
        </div>
    </section>
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <h3 class="text-xl font-bold mb-6 flex items-center">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        LearnHubs
                    </h3>
                    <p class="text-gray-400 mb-4">LearnHubs là nền tảng học trực tuyến hàng đầu giúp mọi người học kinh doanh, phần mềm, công nghệ và kỹ năng sáng tạo để đạt được mục tiêu cá nhân và nghề nghiệp.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-6">Liên kết nhanh</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Về chúng tôi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Khoá học</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Giảng viên</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Sự kiện</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Trở thành giáo viên</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-6">Thông tin liên hệ</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-gray-400"></i>
                            <span class="text-gray-400">123 Đường Học Tập, Boston, MA 02115</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-gray-400"></i>
                            <span class="text-gray-400">+1 (234) 567-8900</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-gray-400"></i>
                            <span class="text-gray-400">support@learnhubsonline.com</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-6">Bản tin</h3>
                    <p class="text-gray-400 mb-4">Đăng ký nhận bản tin để nhận thông tin mới nhất và ưu đãi hấp dẫn.</p>
                    <form class="flex">
                        <input type="email" placeholder="Email của bạn" class="bg-gray-800 text-white px-4 py-2 rounded-l-md focus:outline-none focus:ring-2 focus:ring-purple-500 w-full">
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-r-md">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 mb-4 md:mb-0">© 2023 LearnHubs. Đã đăng ký bản quyền.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white">Chính sách bảo mật</a>
                    <a href="#" class="text-gray-400 hover:text-white">Điều khoản dịch vụ</a>
                    <a href="#" class="text-gray-400 hover:text-white">Sơ đồ trang</a>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.md\\:hidden');
            const mobileMenu = document.querySelector('.md\\:flex');
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                mobileMenu.classList.toggle('flex');
                mobileMenu.classList.toggle('flex-col');
                mobileMenu.classList.toggle('absolute');
                mobileMenu.classList.toggle('top-16');
                mobileMenu.classList.toggle('left-0');
                mobileMenu.classList.toggle('right-0');
                mobileMenu.classList.toggle('bg-white');
                mobileMenu.classList.toggle('shadow-lg');
                mobileMenu.classList.toggle('p-4');
                mobileMenu.classList.toggle('space-y-4');
                mobileMenu.classList.toggle('space-x-8');
            });
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>