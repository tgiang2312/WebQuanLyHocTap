<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'image_data',
        'category',
        'subcategory',
        'level',
        'sessions',
        'price',
        'teacher_id',
        'status',
    ];

    /**
     * Accessor để lấy URL của hình ảnh từ dữ liệu binary
     * 
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        // Nếu có dữ liệu hình ảnh binary
        if (!empty($this->image_data)) {
            // Trả về URL dạng data URI
            return 'data:image/jpeg;base64,' . base64_encode($this->image_data);
        }
        
        // Nếu vẫn còn đường dẫn hình ảnh cũ
        if (!empty($this->image)) {
            return asset('storage/' . $this->image);
        }
        
        // Nếu không có hình ảnh
        return null;
    }

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