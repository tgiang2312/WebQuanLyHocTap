<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Comment;
use App\Models\Enrollment;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Định nghĩa các gate cho phân quyền

        // Admin có toàn quyền
        Gate::before(function (User $user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        // Quản lý khóa học
        Gate::define('view-courses', function (User $user) {
            return true; // Tất cả đều có thể xem danh sách khóa học
        });

        Gate::define('create-course', function (User $user) {
            return $user->isTeacher() || $user->isAdmin();
        });

        Gate::define('update-course', function (User $user, Course $course) {
            return $user->id === $course->teacher_id || $user->isAdmin();
        });

        Gate::define('delete-course', function (User $user, Course $course) {
            return $user->id === $course->teacher_id || $user->isAdmin();
        });

        // Quản lý bài học
        Gate::define('create-lesson', function (User $user, Course $course) {
            return $user->id === $course->teacher_id || $user->isAdmin();
        });

        Gate::define('update-lesson', function (User $user, Lesson $lesson) {
            return $user->id === $lesson->course->teacher_id || $user->isAdmin();
        });

        Gate::define('delete-lesson', function (User $user, Lesson $lesson) {
            return $user->id === $lesson->course->teacher_id || $user->isAdmin();
        });

        // Quản lý bài tập
        Gate::define('create-assignment', function (User $user, Lesson $lesson) {
            return $user->id === $lesson->course->teacher_id || $user->isAdmin();
        });

        Gate::define('update-assignment', function (User $user, Assignment $assignment) {
            return $user->id === $assignment->lesson->course->teacher_id || $user->isAdmin();
        });

        Gate::define('delete-assignment', function (User $user, Assignment $assignment) {
            return $user->id === $assignment->lesson->course->teacher_id || $user->isAdmin();
        });

        // Quản lý bài nộp
        Gate::define('create-submission', function (User $user, Assignment $assignment) {
            return $user->isStudent() && $user->enrolledCourses()->where('course_id', $assignment->lesson->course_id)->exists();
        });

        Gate::define('update-submission', function (User $user, Submission $submission) {
            return $user->id === $submission->user_id;
        });

        Gate::define('delete-submission', function (User $user, Submission $submission) {
            return $user->id === $submission->user_id || $user->isAdmin();
        });

        Gate::define('grade-submission', function (User $user, Submission $submission) {
            return $user->id === $submission->assignment->lesson->course->teacher_id || $user->isAdmin();
        });

        // Quản lý bình luận
        Gate::define('create-comment', function (User $user) {
            return true; // Tất cả người dùng đã đăng nhập đều có thể bình luận
        });

        Gate::define('update-comment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });

        Gate::define('delete-comment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id || 
                   ($comment->commentable_type === 'App\Models\Course' && $user->id === $comment->commentable->teacher_id) ||
                   $user->isAdmin();
        });

        // Quản lý đăng ký khóa học
        Gate::define('enroll-course', function (User $user, Course $course) {
            return $user->isStudent();
        });

        Gate::define('manage-enrollments', function (User $user, Course $course) {
            return $user->id === $course->teacher_id || $user->isAdmin();
        });

        // Quản lý người dùng
        Gate::define('view-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('create-user', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('update-user', function (User $user, User $targetUser) {
            return $user->id === $targetUser->id || $user->isAdmin();
        });

        Gate::define('delete-user', function (User $user, User $targetUser) {
            return ($user->id === $targetUser->id) || $user->isAdmin();
        });

        Gate::define('change-role', function (User $user) {
            return $user->isAdmin();
        });
    }
}
