@extends('layouts.app')

@section('title', 'Hồ sơ cá nhân - LearnHub')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-4">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px;">
                                <span class="fw-bold text-primary fs-1">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="fw-bold mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-muted mb-3">{{ '@'.Auth::user()->username }}</p>
                    
                    <div class="d-flex justify-content-center mb-4">
                        <span class="badge bg-{{ Auth::user()->role == 'teacher' ? 'success' : (Auth::user()->role == 'admin' ? 'danger' : 'primary') }} px-3 py-2">
                            {{ Auth::user()->role == 'teacher' ? 'Giảng viên' : (Auth::user()->role == 'admin' ? 'Quản trị viên' : 'Học viên') }}
                        </span>
                    </div>
                    
                    <div class="d-grid">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="bi bi-pencil-square me-2"></i>Chỉnh sửa hồ sơ
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Thông tin liên hệ</h5>
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope text-muted me-3"></i>
                            <div>
                                <p class="small text-muted mb-0">Email</p>
                                <p class="mb-0">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="fw-bold mb-3 mt-4">Tài khoản liên kết</h5>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-facebook text-primary fs-5 me-3"></i>
                                <span>Facebook</span>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">Liên kết</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-google text-danger fs-5 me-3"></i>
                                <span>Google</span>
                            </div>
                            <button class="btn btn-sm btn-outline-danger">Liên kết</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Tổng quan</h4>
                    
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="bg-light rounded p-3 text-center h-100">
                                <div class="fs-1 text-primary mb-2">{{ Auth::user()->enrolledCourses()->count() ?? 0 }}</div>
                                <p class="mb-0">Khóa học đã đăng ký</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light rounded p-3 text-center h-100">
                                <div class="fs-1 text-success mb-2">{{ Auth::user()->submissions()->count() ?? 0 }}</div>
                                <p class="mb-0">Bài tập đã nộp</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-light rounded p-3 text-center h-100">
                                <div class="fs-1 text-warning mb-2">{{ 0 }}</div>
                                <p class="mb-0">Bình luận</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">Khóa học gần đây</h4>
                        <a href="{{ route('courses.my') }}" class="text-decoration-none">Xem tất cả</a>
                    </div>
                    
                    <div class="list-group list-group-flush">
                        @forelse(Auth::user()->enrolledCourses()->latest()->take(3)->get() as $course)
                            <a href="{{ route('courses.show', $course) }}" class="list-group-item list-group-item-action d-flex align-items-center p-3">
                                <img src="{{ $course->image ?? asset('images/placeholder.jpg') }}" alt="{{ $course->title }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $course->title }}</h6>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1" style="height: 6px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $course->pivot->progress }}%" aria-valuenow="{{ $course->pivot->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ms-2 small">{{ $course->pivot->progress }}%</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted mb-0">Bạn chưa đăng ký khóa học nào.</p>
                                <a href="{{ route('courses.index') }}" class="btn btn-primary mt-3">Khám phá khóa học</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Cài đặt tài khoản</h4>
                    
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3">Đổi mật khẩu</h5>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="currentPassword" placeholder="Mật khẩu hiện tại">
                                        <label for="currentPassword">Mật khẩu hiện tại</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="newPassword" placeholder="Mật khẩu mới">
                                        <label for="newPassword">Mật khẩu mới</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="border-top pt-4">
                        <h5 class="fw-semibold text-danger mb-3">Vùng nguy hiểm</h5>
                        <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            <i class="bi bi-trash me-2"></i>Xóa tài khoản
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Chỉnh sửa hồ sơ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3 text-center">
                        <div class="position-relative d-inline-block">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px;">
                                    <span class="fw-bold text-primary fs-2">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <button type="button" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle">
                                <i class="bi bi-camera"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên người dùng</label>
                        <input type="text" class="form-control" id="username" value="{{ Auth::user()->username }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" disabled>
                    </div>
                    
                    <div class="mb-3">
                        <label for="bio" class="form-label">Giới thiệu</label>
                        <textarea class="form-control" id="bio" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary">Lưu thay đổi</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="deleteAccountModalLabel">Xóa tài khoản</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Cảnh báo:</strong> Hành động này không thể hoàn tác!
                </div>
                <p>Khi xóa tài khoản, tất cả dữ liệu của bạn sẽ bị xóa vĩnh viễn khỏi hệ thống, bao gồm:</p>
                <ul>
                    <li>Thông tin cá nhân</li>
                    <li>Lịch sử học tập</li>
                    <li>Bài tập đã nộp</li>
                    <li>Bình luận và đánh giá</li>
                </ul>
                <div class="mb-3">
                    <label for="confirmDelete" class="form-label">Nhập "XÓA TÀI KHOẢN" để xác nhận:</label>
                    <input type="text" class="form-control" id="confirmDelete" placeholder="XÓA TÀI KHOẢN">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" disabled>Xóa tài khoản</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmDeleteInput = document.getElementById('confirmDelete');
        const deleteButton = document.querySelector('#deleteAccountModal .btn-danger');
        
        confirmDeleteInput.addEventListener('input', function() {
            deleteButton.disabled = this.value !== 'XÓA TÀI KHOẢN';
        });
    });
</script>
@endsection 