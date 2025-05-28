@extends('layouts.app')

@section('title', 'Quản lý khóa học - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Quản lý khóa học</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tạo khóa học mới
        </a>
    </div>
    
    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('teachers.courses') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="published">Đã xuất bản</option>
                        <option value="draft">Bản nháp</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="category" class="form-label">Danh mục</label>
                    <select id="category" name="category" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="programming">Lập trình</option>
                        <option value="design">Thiết kế</option>
                        <option value="marketing">Marketing</option>
                        <option value="business">Kinh doanh</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sort" class="form-label">Sắp xếp theo</label>
                    <select id="sort" name="sort" class="form-select">
                        <option value="newest">Mới nhất</option>
                        <option value="oldest">Cũ nhất</option>
                        <option value="students">Số học viên</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-filter me-2"></i> Lọc
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Courses Table -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 5%">#</th>
                            <th scope="col" style="width: 15%">Ảnh</th>
                            <th scope="col" style="width: 25%">Tên khóa học</th>
                            <th scope="col" style="width: 10%">Danh mục</th>
                            <th scope="col" style="width: 10%">Học viên</th>
                            <th scope="col" style="width: 10%">Ngày tạo</th>
                            <th scope="col" style="width: 10%">Trạng thái</th>
                            <th scope="col" style="width: 15%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $myCreatedCourses = App\Models\Course::where('teacher_id', Auth::id())->latest()->get();
                        @endphp
                        
                        @forelse($myCreatedCourses as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('images/placeholder.jpg') }}" 
                                         alt="{{ $course->title }}" class="img-thumbnail" 
                                         style="width: 80px; height: 60px; object-fit: cover;">
                                </td>
                                <td>
                                    <h6 class="mb-0">{{ $course->title }}</h6>
                                    <small class="text-muted">{{ Str::limit($course->description, 50) }}</small>
                                </td>
                                <td><span class="badge bg-primary">{{ $course->category }}</span></td>
                                <td>{{ $course->enrollments()->count() }}</td>
                                <td>{{ $course->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge {{ $course->status == 'published' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $course->status == 'published' ? 'Đã xuất bản' : 'Bản nháp' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('lessons.create', $course) }}" class="btn btn-outline-success">
                                            <i class="bi bi-plus-circle"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $course->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $course->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $course->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $course->id }}">Xác nhận xóa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bạn có chắc chắn muốn xóa khóa học "{{ $course->title }}"?</p>
                                                    <p class="text-danger fw-bold">Hành động này không thể hoàn tác.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <form action="{{ route('courses.destroy', $course) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Xóa khóa học</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="py-3">
                                        <i class="bi bi-journal-x text-muted" style="font-size: 3rem;"></i>
                                        <h5 class="mt-3">Bạn chưa tạo khóa học nào</h5>
                                        <p class="text-muted">Nhấn vào "Tạo khóa học mới" để bắt đầu</p>
                                        <a href="{{ route('courses.create') }}" class="btn btn-primary mt-2">
                                            <i class="bi bi-plus-circle me-2"></i> Tạo khóa học mới
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-book fs-4 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Tổng khóa học</p>
                        <h3 class="fw-bold mb-0">{{ $myCreatedCourses->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-people-fill fs-4 text-success"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Tổng học viên</p>
                        <h3 class="fw-bold mb-0">
                            @php
                                $totalStudents = 0;
                                foreach($myCreatedCourses as $course) {
                                    $totalStudents += $course->enrollments()->count();
                                }
                            @endphp
                            {{ $totalStudents }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-clipboard-check fs-4 text-warning"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Đã xuất bản</p>
                        <h3 class="fw-bold mb-0">{{ $myCreatedCourses->where('status', 'published')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="bi bi-pencil-square fs-4 text-info"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Bản nháp</p>
                        <h3 class="fw-bold mb-0">{{ $myCreatedCourses->where('status', 'draft')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center">
        <p class="text-muted">Hiển thị 1-10 trong tổng số {{ $myCreatedCourses->count() }} khóa học</p>
        
        <nav aria-label="Phân trang">
            <ul class="pagination mb-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Trước</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Sau</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection 