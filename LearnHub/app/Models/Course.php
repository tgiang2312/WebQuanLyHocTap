<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'teacher_id',
        'status',
    ];

    // Relationship with the teacher (User)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Relationship with lessons
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // Relationship with enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Relationship with enrolled students
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id')
            ->withPivot('status', 'progress')
            ->withTimestamps();
    }
} 