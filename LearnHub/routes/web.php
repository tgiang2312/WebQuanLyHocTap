<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\CommentController;

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
    return view('homepage');
});

// Auth routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Course routes
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->middleware('auth')->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->middleware('auth')->name('courses.store');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->middleware('auth')->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware('auth')->name('courses.update');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->middleware('auth')->name('courses.destroy');
Route::get('/my-courses', [CourseController::class, 'myCourses'])->middleware('auth')->name('courses.my');

// Lesson routes
Route::get('/courses/{course}/lessons/create', [LessonController::class, 'create'])->middleware('auth')->name('lessons.create');
Route::post('/courses/{course}/lessons', [LessonController::class, 'store'])->middleware('auth')->name('lessons.store');
Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->middleware('auth')->name('lessons.edit');
Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->middleware('auth')->name('lessons.update');
Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->middleware('auth')->name('lessons.destroy');
Route::post('/courses/{course}/lessons/reorder', [LessonController::class, 'reorder'])->middleware('auth')->name('lessons.reorder');

// Enrollment routes
Route::get('/enrollments', [EnrollmentController::class, 'index'])->middleware('auth')->name('enrollments.index');
Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->middleware('auth')->name('enrollments.enroll');
Route::post('/courses/{course}/update-progress', [EnrollmentController::class, 'updateProgress'])->middleware('auth')->name('enrollments.progress');
Route::delete('/courses/{course}/drop', [EnrollmentController::class, 'destroy'])->middleware('auth')->name('enrollments.drop');
Route::get('/courses/{course}/students', [EnrollmentController::class, 'students'])->middleware('auth')->name('enrollments.students');

// Assignment routes
Route::get('/lessons/{lesson}/assignments/create', [AssignmentController::class, 'create'])->middleware('auth')->name('assignments.create');
Route::post('/lessons/{lesson}/assignments', [AssignmentController::class, 'store'])->middleware('auth')->name('assignments.store');
Route::get('/assignments/{assignment}', [AssignmentController::class, 'show'])->name('assignments.show');
Route::get('/assignments/{assignment}/edit', [AssignmentController::class, 'edit'])->middleware('auth')->name('assignments.edit');
Route::put('/assignments/{assignment}', [AssignmentController::class, 'update'])->middleware('auth')->name('assignments.update');
Route::delete('/assignments/{assignment}', [AssignmentController::class, 'destroy'])->middleware('auth')->name('assignments.destroy');
Route::get('/assignments/{assignment}/submissions', [AssignmentController::class, 'submissions'])->middleware('auth')->name('assignments.submissions');

// Submission routes
Route::get('/assignments/{assignment}/submit', [SubmissionController::class, 'create'])->middleware('auth')->name('submissions.create');
Route::post('/assignments/{assignment}/submit', [SubmissionController::class, 'store'])->middleware('auth')->name('submissions.store');
Route::get('/submissions/{submission}', [SubmissionController::class, 'show'])->middleware('auth')->name('submissions.show');
Route::post('/submissions/{submission}/grade', [SubmissionController::class, 'grade'])->middleware('auth')->name('submissions.grade');
Route::get('/submissions/{submission}/download', [SubmissionController::class, 'download'])->middleware('auth')->name('submissions.download');

// Comment routes
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->middleware('auth')->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth')->name('comments.destroy');