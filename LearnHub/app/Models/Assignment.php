<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
        'description',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    // Relationship with lesson
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // Relationship with submissions
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
} 