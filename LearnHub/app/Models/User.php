<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'avatar',
        'bio',
        'phone',
        'birthday',
        'title',
        'expertise',
        'experience',
        'email_notifications',
        'language',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    // Courses taught by teacher
    public function teachingCourses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }
    
    // Enrollments as student
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    
    // Courses enrolled as student
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id')
            ->withPivot('status', 'progress')
            ->withTimestamps();
    }
    
    // Assignment submissions
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
    
    // Comments made by user
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    // Check if user is admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    // Check if user is teacher
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }
    
    // Check if user is student
    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * Lấy số khóa học đã tạo (cho giảng viên)
     */
    public function getCoursesCountAttribute()
    {
        if ($this->role !== 'teacher') {
            return 0;
        }
        
        return $this->teachingCourses()->count();
    }

    /**
     * Lấy số khóa học đã đăng ký (cho học viên)
     */
    public function getEnrollmentsCountAttribute()
    {
        if ($this->role !== 'student') {
            return 0;
        }
        
        return $this->enrollments()->count();
    }

    /**
     * Lấy số khóa học đã hoàn thành (cho học viên)
     */
    public function getCompletedCoursesCountAttribute()
    {
        if ($this->role !== 'student') {
            return 0;
        }
        
        return $this->enrollments()->where('completed', true)->count();
    }

    /**
     * Lấy số thành tích đã đạt được (cho học viên)
     */
    public function getAchievementsCountAttribute()
    {
        return $this->achievements()->count();
    }

    /**
     * Các thành tích của người dùng
     */
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}
