@extends('layouts.app')

@section('title', 'Quản lý khóa học - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Quản lý khóa học</h1>
        <div>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i> Tạo khóa học mới
            </a>
        </div>
    </div>
    
    <!-- Filter and Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.courses') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group search-form">
                        <input type="text" class="form-control" placeholder="Tìm kiếm khóa học..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search me-1"></i> Tìm kiếm
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-select">
                        <option value="">Tất cả danh mục</option>
                        <option value="lap-trinh" {{ request('category') == 'lap-trinh' ? 'selected' : '' }}>Lập trình</option>
                        <option value="marketing" {{ request('category') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="thiet-ke" {{ request('category') == 'thiet-ke' ? 'selected' : '' }}>Thiết kế</option>
                        <option value="kinh-doanh" {{ request('category') == 'kinh-doanh' ? 'selected' : '' }}>Kinh doanh</option>
                        <option value="ngoai-ngu" {{ request('category') == 'ngoai-ngu' ? 'selected' : '' }}>Ngoại ngữ</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-select">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ biến nhất</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Lọc</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Courses Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Khóa học</th>
                            <th>Danh mục</th>
                            <th>Giảng viên</th>
                            <th>Học viên</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $courses = \App\Models\Course::with('teacher')->latest()->paginate(10);
                        @endphp
                        
                        @foreach($courses as $course)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $course->id }}">
                                </div>
                            </td>
                            <td>{{ $course->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $course->image_data || $course->image ? $course->imageUrl : asset('images/course-placeholder.jpg') }}" 
                                             alt="{{ $course->title }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="fw-medium mb-0">{{ $course->title }}</h6>
                                        <small class="text-muted">{{ Str::limit($course->description, 50) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $course->category }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $course->teacher->avatar ? asset('storage/' . $course->teacher->avatar) : asset('images/avatar-placeholder.jpg') }}" 
                                             alt="{{ $course->teacher->name }}" class="rounded-circle" width="30" height="30">
                                    </div>
                                    <div class="ms-2">
                                        {{ $course->teacher->name }}
                                    </div>
                                </div>
                            </td>
                            <td>{{ $course->enrollments()->count() }}</td>
                            <td>
                                @if($course->status === 'published')
                                    <span class="badge bg-success">Đã xuất bản</span>
                                @else
                                    <span class="badge bg-warning">Bản nháp</span>
                                @endif
                            </td>
                            <td>{{ $course->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Thao tác
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('courses.show', $course) }}"><i class="bi bi-eye me-2"></i>Xem</a></li>
                                        <li><a class="dropdown-item" href="{{ route('courses.edit', $course) }}"><i class="bi bi-pencil me-2"></i>Sửa</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Bạn có chắc muốn xóa khóa học này?')">
                                                    <i class="bi bi-trash me-2"></i>Xóa
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Hiển thị {{ $courses->firstItem() ?? 0 }} đến {{ $courses->lastItem() ?? 0 }} trong tổng số {{ $courses->total() ?? 0 }} khóa học
                </div>
                <div>
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Course Statistics -->
    <div class="row g-4 mt-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-semibold mb-0">Khóa học theo danh mục</h4>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="coursesByCategoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-semibold mb-0">Khóa học phổ biến nhất</h4>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @php
                            $popularCourses = \App\Models\Course::withCount('enrollments')
                                ->orderBy('enrollments_count', 'desc')
                                ->take(5)
                                ->get();
                        @endphp
                        
                        @foreach($popularCourses as $course)
                            <div class="list-group-item px-4 py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('images/course-placeholder.jpg') }}" 
                                             alt="{{ $course->title }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                                        <div class="ms-3">
                                            <h6 class="fw-medium mb-0">{{ $course->title }}</h6>
                                            <small class="text-muted">{{ $course->teacher->name }}</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-success rounded-pill">{{ $course->enrollments_count }} học viên</span>
                                </div>
                            </div>
                        @endforeach
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
        // Handle "Select All" checkbox
        const selectAllCheckbox = document.getElementById('selectAll');
        const courseCheckboxes = document.querySelectorAll('tbody .form-check-input');
        
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                courseCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
        }
        
        // Courses by Category Chart
        const categoryCtx = document.getElementById('coursesByCategoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: ['Lập trình', 'Marketing', 'Thiết kế', 'Kinh doanh', 'Ngoại ngữ'],
                datasets: [{
                    label: 'Số khóa học',
                    data: [
                        {{ \App\Models\Course::where('category', 'lap-trinh')->count() }},
                        {{ \App\Models\Course::where('category', 'marketing')->count() }},
                        {{ \App\Models\Course::where('category', 'thiet-ke')->count() }},
                        {{ \App\Models\Course::where('category', 'kinh-doanh')->count() }},
                        {{ \App\Models\Course::where('category', 'ngoai-ngu')->count() }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endsection 