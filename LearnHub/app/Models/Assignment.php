<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'course_id',
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

    // Relationship with course through lesson
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship with submissions
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    /**
     * Các model liên quan sẽ được cập nhật khi model này thay đổi
     */
    protected $touches = ['lesson'];

    /**
     * Boot model
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($assignment) {
            if (!$assignment->course_id && $assignment->lesson_id) {
                $lesson = Lesson::find($assignment->lesson_id);
                if ($lesson) {
                    $assignment->course_id = $lesson->course_id;
                }
            }
        });
    }
} 