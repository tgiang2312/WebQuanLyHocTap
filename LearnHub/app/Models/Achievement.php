<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'icon',
        'type',
        'points',
    ];

    /**
     * Mối quan hệ với người dùng
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 