<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'progress',
        'completed',
        'last_lesson_id',
        'last_lesson_title',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    // Relationship with user (student)
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    // Relationship with completed lessons
    public function completedLessons()
    {
        return $this->belongsToMany(Lesson::class, 'completed_lessons', 'enrollment_id', 'lesson_id')
                    ->withTimestamps();
    }
    
    // Last viewed lesson
    public function lastLesson()
    {
        return $this->belongsTo(Lesson::class, 'last_lesson_id');
    }
} 