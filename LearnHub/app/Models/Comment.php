<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'commentable_id',
        'commentable_type',
        'content',
    ];

    // Polymorphic relationship
    public function commentable()
    {
        return $this->morphTo();
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 