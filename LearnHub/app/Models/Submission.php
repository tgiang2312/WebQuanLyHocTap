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
        'grade',
        'feedback',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
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