<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

// Auth routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.login', ['tab' => 'register']);
})->name('register');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user && ($user->role === 'teacher' || $user->role === 'admin')) {
        return redirect()->route('teachers.dashboard');
    } else {
        return redirect()->route('students.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard related routes
Route::get('/dashboard/courses', function() {
    // Giữ nguyên logic dữ liệu mẫu từ dashboard
    $enrolledCourses = [
        [
            'id' => 1,
            'title' => 'Lập trình PHP cơ bản',
            'instructor' => 'Nguyễn Văn A',
            'category' => 'Lập trình',
            'progress' => 75,
            'lastLesson' => 'Bài 8: Làm việc với Database',
            'image' => 'images/courses/php.jpg',
            'completed' => false
        ],
        [
            'id' => 2,
            'title' => 'JavaScript nâng cao',
            'instructor' => 'Trần Thị B',
            'category' => 'Web',
            'progress' => 40,
            'lastLesson' => 'Bài 4: Promises và Async/Await',
            'image' => 'images/courses/js.jpg',
            'completed' => false
        ],
        [
            'id' => 3,
            'title' => 'HTML & CSS cơ bản',
            'instructor' => 'Lê Văn C',
            'category' => 'Web',
            'progress' => 100,
            'lastLesson' => 'Bài 10: Responsive Design',
            'image' => 'images/courses/html.jpg',
            'completed' => true
        ]
    ];
    
    return view('dashboard.courses', compact('enrolledCourses'));
})->middleware('auth')->name('dashboard.courses');

Route::get('/assignments', function() {
    $assignments = [
        [
            'id' => 1,
            'title' => 'Xây dựng trang web portfolio',
            'course' => 'HTML & CSS cơ bản',
            'dueDate' => now()->addDays(3)
        ],
        [
            'id' => 2,
            'title' => 'Tạo ứng dụng Todo List',
            'course' => 'JavaScript nâng cao',
            'dueDate' => now()->addDays(5)
        ]
    ];
    
    return view('assignments.index', compact('assignments'));
})->middleware('auth')->name('assignments.index');

Route::get('/achievements', function() {
    $achievements = [
        [
            'icon' => '🏆',
            'title' => 'Hoàn thành khóa học đầu tiên',
            'date' => now()->subDays(10)
        ],
        [
            'icon' => '⭐',
            'title' => 'Nộp 5 bài tập đúng hạn',
            'date' => now()->subDays(5)
        ]
    ];
    
    return view('achievements.index', compact('achievements'));
})->middleware('auth')->name('achievements.index');

// Course routes
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/search', [CourseController::class, 'search'])->name('courses.search');
Route::get('/courses/create', [CourseController::class, 'create'])->middleware(['auth', 'role:teacher,admin'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->middleware(['auth', 'role:teacher,admin'])->name('courses.store');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{course}/learn', [CourseController::class, 'learn'])->middleware('auth')->name('courses.learn');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->middleware(['auth'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware(['auth'])->name('courses.update');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->middleware(['auth'])->name('courses.destroy');
Route::get('/my-courses', [CourseController::class, 'myCourses'])->middleware('auth')->name('courses.my');
Route::get('/courses/category/{category}', [CourseController::class, 'category'])->name('courses.category');
Route::get('/courses/category/{category}/{subcategory}', [CourseController::class, 'subcategory'])->name('courses.subcategory');

// Lesson routes
Route::get('/courses/{course}/lessons/create', [LessonController::class, 'create'])->middleware(['auth', 'role:teacher,admin'])->name('lessons.create');
Route::post('/courses/{course}/lessons', [LessonController::class, 'store'])->middleware(['auth', 'role:teacher,admin'])->name('lessons.store');
Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->middleware('auth')->name('lessons.show');
Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->middleware('auth')->name('lessons.edit');
Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->middleware('auth')->name('lessons.update');
Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->middleware('auth')->name('lessons.destroy');
Route::post('/courses/{course}/lessons/reorder', [LessonController::class, 'reorder'])->middleware(['auth', 'role:teacher,admin'])->name('lessons.reorder');

// Enrollment routes
Route::get('/enrollments', [EnrollmentController::class, 'index'])->middleware('auth')->name('enrollments.index');
Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->middleware('auth')->name('enrollments.enroll');
Route::post('/courses/{course}/update-progress', [EnrollmentController::class, 'updateProgress'])->middleware('auth')->name('enrollments.progress');
Route::delete('/courses/{course}/drop', [EnrollmentController::class, 'destroy'])->middleware('auth')->name('enrollments.drop');
Route::get('/courses/{course}/students', [EnrollmentController::class, 'students'])->middleware('auth')->name('enrollments.students');

// Assignment routes
Route::get('/lessons/{lesson}/assignments/create', [AssignmentController::class, 'create'])->middleware(['auth', 'role:teacher,admin'])->name('assignments.create');
Route::post('/lessons/{lesson}/assignments', [AssignmentController::class, 'store'])->middleware(['auth', 'role:teacher,admin'])->name('assignments.store');
Route::get('/assignments/{assignment}', [AssignmentController::class, 'show'])->middleware('auth')->name('assignments.show');
Route::get('/assignments/{assignment}/edit', [AssignmentController::class, 'edit'])->middleware(['auth', 'role:teacher,admin'])->name('assignments.edit');
Route::put('/assignments/{assignment}', [AssignmentController::class, 'update'])->middleware(['auth', 'role:teacher,admin'])->name('assignments.update');
Route::delete('/assignments/{assignment}', [AssignmentController::class, 'destroy'])->middleware(['auth', 'role:teacher,admin'])->name('assignments.destroy');
Route::get('/assignments/{assignment}/submissions', [AssignmentController::class, 'submissions'])->middleware(['auth', 'role:teacher,admin'])->name('assignments.submissions');

// Submission routes
Route::get('/assignments/{assignment}/submit', [SubmissionController::class, 'create'])->middleware(['auth', 'role:student'])->name('submissions.create');
Route::post('/assignments/{assignment}/submit', [SubmissionController::class, 'store'])->middleware(['auth', 'role:student'])->name('submissions.store');
Route::get('/submissions/{submission}', [SubmissionController::class, 'show'])->middleware('auth')->name('submissions.show');
Route::post('/submissions/{submission}/grade', [SubmissionController::class, 'grade'])->middleware(['auth', 'role:teacher,admin'])->name('submissions.grade');
Route::get('/submissions/{submission}/download', [SubmissionController::class, 'download'])->middleware('auth')->name('submissions.download');

// Comment routes
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->middleware('auth')->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth')->name('comments.destroy');

// About page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('auth/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [LoginController::class, 'handleProviderCallback']);

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/courses', [AdminController::class, 'courses'])->name('admin.courses');
});

// Student Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('students.dashboard');
    Route::get('/student/courses', [StudentController::class, 'courses'])->name('students.courses');
    Route::get('/student/assignments', [StudentController::class, 'assignments'])->name('students.assignments');
    Route::get('/student/achievements', [StudentController::class, 'achievements'])->name('students.achievements');
});

// Teacher Routes
Route::middleware(['auth', 'verified', 'teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teachers.dashboard');
    Route::get('/teacher/courses', [TeacherController::class, 'courses'])->name('teachers.courses');
    Route::get('/teacher/assignments', [TeacherController::class, 'assignments'])->name('teachers.assignments');
    Route::get('/teacher/assignments/create', [TeacherController::class, 'createAssignment'])->name('teachers.assignments.create');
    Route::post('/teacher/assignments', [TeacherController::class, 'storeAssignment'])->name('teachers.assignments.store');
    Route::get('/teacher/assignments/create-form', [TeacherController::class, 'createFormAssignment'])->name('teachers.assignments.create_form');
    Route::post('/teacher/assignments/form', [TeacherController::class, 'storeFormAssignment'])->name('teachers.assignments.store_form');
    Route::get('/teacher/analytics', [TeacherController::class, 'analytics'])->name('teachers.analytics');
    Route::get('/teacher/activities', [TeacherController::class, 'activities'])->name('teachers.activities');
});