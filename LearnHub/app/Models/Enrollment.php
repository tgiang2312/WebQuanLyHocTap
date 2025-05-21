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
} 