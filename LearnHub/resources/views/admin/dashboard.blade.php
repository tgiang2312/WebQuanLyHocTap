@extends('layouts.app')

@section('title', 'Thống kê người dùng - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Thống kê người dùng</h1>
        <div>
            <a href="{{ route('admin.users') }}" class="btn btn-outline-primary me-2">
                <i class="bi bi-people me-2"></i> Quản lý người dùng
            </a>
            <a href="{{ route('admin.courses') }}" class="btn btn-outline-primary">
                <i class="bi bi-book me-2"></i> Quản lý khóa học
            </a>
        </div>
    </div>
    
    @php
        $totalUsers = \App\Models\User::count();
        $totalStudents = \App\Models\User::where('role', 'student')->count();
        $totalTeachers = \App\Models\User::where('role', 'teacher')->count();
        $totalCourses = \App\Models\Course::count();
        $totalEnrollments = \App\Models\Enrollment::count();
        $totalCompletedCourses = \App\Models\Enrollment::where('completed', true)->count();
    @endphp
    
    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-people-fill fs-4 text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $totalUsers }}</h5>
                            <p class="text-muted mb-0">Tổng người dùng</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="text-center">
                            <h5 class="fw-bold mb-0">{{ $totalStudents }}</h5>
                            <p class="text-muted small mb-0">Học viên</p>
                        </div>
                        <div class="text-center">
                            <h5 class="fw-bold mb-0">{{ $totalTeachers }}</h5>
                            <p class="text-muted small mb-0">Giảng viên</p>
                        </div>
                        <div class="text-center">
                            <h5 class="fw-bold mb-0">{{ $totalUsers - $totalStudents - $totalTeachers }}</h5>
                            <p class="text-muted small mb-0">Admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-mortarboard-fill fs-4 text-success"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $totalCourses }}</h5>
                            <p class="text-muted mb-0">Tổng khóa học</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="text-center">
                            <h5 class="fw-bold mb-0">{{ \App\Models\Course::where('status', 'published')->count() }}</h5>
                            <p class="text-muted small mb-0">Đã xuất bản</p>
                        </div>
                        <div class="text-center">
                            <h5 class="fw-bold mb-0">{{ \App\Models\Course::where('status', 'draft')->count() }}</h5>
                            <p class="text-muted small mb-0">Bản nháp</p>
                        </div>
                        <div class="text-center">
                            <h5 class="fw-bold mb-0">{{ \App\Models\Lesson::count() }}</h5>
                            <p class="text-muted small mb-0">Bài học</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-graph-up fs-4 text-info"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $totalEnrollments }}</h5>
                            <p class="text-muted mb-0">Tổng đăng ký</p>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="text-center">
                            <h5 class="fw-bold mb-0">{{ $totalCompletedCourses }}</h5>
                            <p class="text-muted small mb-0">Hoàn thành</p>
                        </div>
                        <div class="text-center">
                            <h5 class="fw-bold mb-0">{{ round(($totalCompletedCourses / max(1, $totalEnrollments)) * 100) }}%</h5>
                            <p class="text-muted small mb-0">Tỷ lệ hoàn thành</p>
                        </div>
                        <div class="text-center">
                            <h5 class="fw-bold mb-0">{{ \App\Models\Submission::count() }}</h5>
                            <p class="text-muted small mb-0">Bài nộp</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Active Users Chart -->
    <div class="row g-4 mb-5">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-semibold mb-0">Thống kê người dùng hoạt động</h4>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="userActivityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-semibold mb-0">Phân bố người dùng</h4>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="chart-container" style="height: 250px; width: 250px;">
                        <canvas id="userDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Latest Registrations -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="fw-semibold mb-0">Đăng ký mới nhất</h4>
                    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $recentUsers = \App\Models\User::latest()->take(5)->get();
                                @endphp
                                
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/avatar-placeholder.jpg') }}" class="rounded-circle" width="40" height="40" alt="{{ $user->name }}">
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="fw-medium mb-0">{{ $user->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role === 'admin')
                                            <span class="badge bg-danger">Quản trị viên</span>
                                        @elseif($user->role === 'teacher')
                                            <span class="badge bg-primary">Giảng viên</span>
                                        @else
                                            <span class="badge bg-success">Học viên</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-outline-primary">Xem</a>
                                            <a href="#" class="btn btn-outline-secondary">Sửa</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User Activity Chart
        const activityCtx = document.getElementById('userActivityChart').getContext('2d');
        const activityChart = new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                datasets: [{
                    label: 'Người dùng mới',
                    data: [65, 78, 90, 105, 112, 120, 135, 150, 162, 170, 185, 192],
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    fill: true,
                    tension: 0.4
                }, {
                    label: 'Người dùng hoạt động',
                    data: [40, 52, 67, 70, 78, 95, 110, 125, 130, 145, 155, 170],
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // User Distribution Chart
        const distributionCtx = document.getElementById('userDistributionChart').getContext('2d');
        const distributionChart = new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Học viên', 'Giảng viên', 'Quản trị viên'],
                datasets: [{
                    data: [{{ $totalStudents }}, {{ $totalTeachers }}, {{ $totalUsers - $totalStudents - $totalTeachers }}],
                    backgroundColor: [
                        'rgba(25, 135, 84, 0.8)',
                        'rgba(13, 110, 253, 0.8)',
                        'rgba(220, 53, 69, 0.8)'
                    ],
                    borderColor: [
                        'rgba(25, 135, 84, 1)',
                        'rgba(13, 110, 253, 1)',
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
@endsection 