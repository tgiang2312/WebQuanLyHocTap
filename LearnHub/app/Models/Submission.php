<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'user_id',
        'content',
        'file_url',
        'file_path',
        'file_name',
        'grade',
        'score',
        'feedback',
        'submitted_at',
        'graded_at',
        'status',
        'is_late',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'graded_at' => 'datetime',
        'is_late' => 'boolean',
    ];

    // Relationship with assignment
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    // Relationship with student
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
} 