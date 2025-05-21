<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduManage - Hệ thống quản lý học tập trực tuyến</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        .sidebar.collapsed .logo-text {
            display: none;
        }
        .sidebar.collapsed .user-info {
            display: none;
        }
        .main-content {
            transition: all 0.3s ease;
        }
        .main-content.expanded {
            margin-left: 70px;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
        }
        .progress-ring__circle {
            transition: stroke-dashoffset 0.35s;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-indigo-800 text-white w-64 flex flex-col">
            <!-- Logo -->
            <div class="p-4 flex items-center justify-between border-b border-indigo-700">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-2xl mr-3"></i>
                    <span class="logo-text text-xl font-bold">EduManage</span>
                </div>
                <button id="toggleSidebar" class="text-white focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <!-- User Profile -->
            <div class="user-info p-4 flex items-center border-b border-indigo-700">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="w-10 h-10 rounded-full mr-3">
                <div>
                    <div class="font-medium">Nguyễn Thị Mai</div>
                    <div class="text-xs text-indigo-200">Học viên</div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto">
                <ul class="py-2">
                    <li>
                        <a href="#" class="flex items-center p-3 text-white hover:bg-indigo-700 active-nav">
                            <i class="fas fa-home mr-3"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 text-white hover:bg-indigo-700">
                            <i class="fas fa-book mr-3"></i>
                            <span class="sidebar-text">Khóa học của tôi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 text-white hover:bg-indigo-700">
                            <i class="fas fa-calendar-alt mr-3"></i>
                            <span class="sidebar-text">Lịch học</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 text-white hover:bg-indigo-700">
                            <i class="fas fa-tasks mr-3"></i>
                            <span class="sidebar-text">Bài tập</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 text-white hover:bg-indigo-700">
                            <i class="fas fa-chart-line mr-3"></i>
                            <span class="sidebar-text">Tiến trình học</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 text-white hover:bg-indigo-700">
                            <i class="fas fa-comments mr-3"></i>
                            <span class="sidebar-text">Thảo luận</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 text-white hover:bg-indigo-700">
                            <i class="fas fa-cog mr-3"></i>
                            <span class="sidebar-text">Cài đặt</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- Collapse Button -->
            <div class="p-4 border-t border-indigo-700">
                <button class="w-full bg-indigo-700 hover:bg-indigo-600 text-white py-2 px-4 rounded flex items-center justify-center">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span class="sidebar-text">Đăng xuất</span>
                </button>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content flex-1 overflow-y-auto">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button id="notificationBtn" class="text-gray-600 hover:text-indigo-600 focus:outline-none relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="notification-badge bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                            </button>
                            <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg z-10">
                                <div class="p-3 border-b">
                                    <h3 class="font-medium">Thông báo (3)</h3>
                                </div>
                                <div class="max-h-60 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-100 border-b">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 text-indigo-600">
                                                <i class="fas fa-book"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium">Bài tập mới: Toán cao cấp</p>
                                                <p class="text-xs text-gray-500">2 giờ trước</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-100 border-b">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 text-blue-600">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium">Lịch học thay đổi: Lập trình Web</p>
                                                <p class="text-xs text-gray-500">Hôm qua</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-100">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 text-green-600">
                                                <i class="fas fa-comment"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium">Bạn có tin nhắn mới từ giảng viên</p>
                                                <p class="text-xs text-gray-500">2 ngày trước</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 text-center bg-gray-50">
                                    <a href="#" class="text-sm text-indigo-600 font-medium">Xem tất cả</a>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <button id="userMenuBtn" class="flex items-center focus:outline-none">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="w-8 h-8 rounded-full">
                                <span class="ml-2 text-gray-700 hidden md:inline">Nguyễn Thị Mai</span>
                                <i class="fas fa-chevron-down ml-1 text-gray-600 text-xs"></i>
                            </button>
                            <div id="userMenuDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Hồ sơ cá nhân</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cài đặt</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                            <i class="fas fa-book-open text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Khóa học đang học</p>
                            <h3 class="text-2xl font-bold">5</h3>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-tasks text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Bài tập chưa nộp</p>
                            <h3 class="text-2xl font-bold">3</h3>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-calendar-check text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Buổi học hôm nay</p>
                            <h3 class="text-2xl font-bold">2</h3>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6 flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                            <i class="fas fa-chart-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Tiến độ trung bình</p>
                            <h3 class="text-2xl font-bold">78%</h3>
                        </div>
                    </div>
                </div>
                
                <!-- Courses Section -->
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-4 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Khóa học của tôi</h2>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">Xem tất cả</a>
                    </div>
                    <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Course Card 1 -->
                        <div class="course-card bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                            <div class="h-40 bg-indigo-600 flex items-center justify-center">
                                <i class="fas fa-laptop-code text-white text-5xl"></i>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-lg text-gray-800">Lập trình Web</h3>
                                    <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">Đang học</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Học HTML, CSS, JavaScript và các framework hiện đại</p>
                                <div class="flex items-center justify-between">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: 65%"></div>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">65%</span>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-user-graduate mr-1"></i>
                                        <span>GS. Trần Văn A</span>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Tiếp tục</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Course Card 2 -->
                        <div class="course-card bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                            <div class="h-40 bg-blue-600 flex items-center justify-center">
                                <i class="fas fa-calculator text-white text-5xl"></i>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-lg text-gray-800">Toán cao cấp</h3>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Đang học</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Đại số tuyến tính, Giải tích và Xác suất thống kê</p>
                                <div class="flex items-center justify-between">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: 45%"></div>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">45%</span>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-user-graduate mr-1"></i>
                                        <span>PGS. Lê Thị B</span>
                                    </div>
                                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Tiếp tục</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Course Card 3 -->
                        <div class="course-card bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                            <div class="h-40 bg-green-600 flex items-center justify-center">
                                <i class="fas fa-database text-white text-5xl"></i>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-lg text-gray-800">Cơ sở dữ liệu</h3>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Đang học</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">SQL, NoSQL và thiết kế cơ sở dữ liệu quan hệ</p>
                                <div class="flex items-center justify-between">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 78%"></div>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">78%</span>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-user-graduate mr-1"></i>
                                        <span>TS. Phạm Văn C</span>
                                    </div>
                                    <button class="text-green-600 hover:text-green-800 text-sm font-medium">Tiếp tục</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Upcoming Classes & Recent Activities -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Upcoming Classes -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Lịch học sắp tới</h2>
                        </div>
                        <div class="p-4">
                            <div class="space-y-4">
                                <!-- Class 1 -->
                                <div class="flex items-start">
                                    <div class="bg-indigo-100 text-indigo-800 p-2 rounded-lg mr-4">
                                        <div class="text-center">
                                            <div class="font-bold">15</div>
                                            <div class="text-xs">Th6</div>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">Lập trình Web - Buổi 8</h4>
                                        <p class="text-sm text-gray-600">9:00 - 11:00 | Phòng ảo Zoom</p>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <i class="fas fa-user-graduate mr-2"></i>
                                            <span>GS. Trần Văn A</span>
                                        </div>
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-800">
                                        <i class="fas fa-external-link-alt"></i>
                                    </button>
                                </div>
                                
                                <!-- Class 2 -->
                                <div class="flex items-start">
                                    <div class="bg-blue-100 text-blue-800 p-2 rounded-lg mr-4">
                                        <div class="text-center">
                                            <div class="font-bold">15</div>
                                            <div class="text-xs">Th6</div>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">Toán cao cấp - Buổi 5</h4>
                                        <p class="text-sm text-gray-600">14:00 - 16:00 | Phòng ảo Teams</p>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <i class="fas fa-user-graduate mr-2"></i>
                                            <span>PGS. Lê Thị B</span>
                                        </div>
                                    </div>
                                    <button class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-external-link-alt"></i>
                                    </button>
                                </div>
                                
                                <!-- Class 3 -->
                                <div class="flex items-start">
                                    <div class="bg-green-100 text-green-800 p-2 rounded-lg mr-4">
                                        <div class="text-center">
                                            <div class="font-bold">16</div>
                                            <div class="text-xs">Th6</div>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">Cơ sở dữ liệu - Buổi 10</h4>
                                        <p class="text-sm text-gray-600">8:00 - 10:00 | Phòng ảo Google Meet</p>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <i class="fas fa-user-graduate mr-2"></i>
                                            <span>TS. Phạm Văn C</span>
                                        </div>
                                    </div>
                                    <button class="text-green-600 hover:text-green-800">
                                        <i class="fas fa-external-link-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Xem lịch học đầy đủ</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activities -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Hoạt động gần đây</h2>
                        </div>
                        <div class="p-4">
                            <div class="space-y-4">
                                <!-- Activity 1 -->
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-3">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                            <i class="fas fa-tasks"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-800">
                                            <span class="font-medium">Bạn đã nộp bài tập</span> Lập trình Web - Bài tập 3
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">Hôm qua, 15:30</p>
                                    </div>
                                </div>
                                
                                <!-- Activity 2 -->
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-3">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                            <i class="fas fa-comment"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-800">
                                            <span class="font-medium">Bạn có phản hồi mới</span> từ giảng viên về bài tập Toán
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">2 ngày trước, 09:15</p>
                                    </div>
                                </div>
                                
                                <!-- Activity 3 -->
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-3">
                                        <div class="h-10 w-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                            <i class="fas fa-video"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-800">
                                            <span class="font-medium">Buổi học đã được ghi hình</span> Cơ sở dữ liệu - Buổi 9
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">3 ngày trước, 16:45</p>
                                    </div>
                                </div>
                                
                                <!-- Activity 4 -->
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-3">
                                        <div class="h-10 w-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-800">
                                            <span class="font-medium">Tài liệu mới đã được đăng</span> Toán cao cấp - Chương 3
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">4 ngày trước, 11:20</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Xem tất cả hoạt động</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pending Assignments -->
                <div class="bg-white rounded-lg shadow mt-6">
                    <div class="p-4 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Bài tập chưa hoàn thành</h2>
                        <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">Xem tất cả</a>
                    </div>
                    <div class="p-4">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bài tập</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Môn học</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hạn nộp</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-gray-900">Bài tập 4 - Form đăng ký</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-gray-900">Lập trình Web</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-gray-900">20/06/2023</div>
                                            <div class="text-sm text-gray-500">Còn 5 ngày</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Chưa nộp</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Xem chi tiết</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Nộp bài</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-gray-900">Bài tập 2 - Ma trận</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-gray-900">Toán cao cấp</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-gray-900">18/06/2023</div>
                                            <div class="text-sm text-red-500">Còn 3 ngày</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Chưa nộp</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Xem chi tiết</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Nộp bài</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-gray-900">Bài tập 3 - Thiết kế CSDL</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-gray-900">Cơ sở dữ liệu</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-gray-900">22/06/2023</div>
                                            <div class="text-sm text-gray-500">Còn 7 ngày</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Đang làm</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Xem chi tiết</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Tiếp tục</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Toggle Sidebar
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });
        
        // Notification Dropdown
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationDropdown = document.getElementById('notificationDropdown');
        
        notificationBtn.addEventListener('click', () => {
            notificationDropdown.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
                notificationDropdown.classList.add('hidden');
            }
        });
        
        // User Menu Dropdown
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userMenuDropdown = document.getElementById('userMenuDropdown');
        
        userMenuBtn.addEventListener('click', () => {
            userMenuDropdown.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuBtn.contains(e.target) && !userMenuDropdown.contains(e.target)) {
                userMenuDropdown.classList.add('hidden');
            }
        });
        
        // Active Navigation
        const navItems = document.querySelectorAll('nav ul li a');
        
        navItems.forEach(item => {
            item.addEventListener('click', () => {
                navItems.forEach(i => i.classList.remove('active-nav', 'bg-indigo-700'));
                item.classList.add('active-nav', 'bg-indigo-700');
            });
        });
        
        // Course Card Hover Effect
        const courseCards = document.querySelectorAll('.course-card');
        
        courseCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('hover:shadow-lg');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('hover:shadow-lg');
            });
        });
    </script>
</body>
</html>