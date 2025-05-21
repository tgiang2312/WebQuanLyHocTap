<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content',
        'video_url',
        'order_number',
    ];

    // Relationship with course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship with assignments
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
} 