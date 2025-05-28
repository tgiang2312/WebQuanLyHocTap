<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'activity_type',
        'title',
        'description',
        'icon',
    ];

    /**
     * Mối quan hệ với người dùng
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mối quan hệ với khóa học
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Tạo hoạt động mới
     */
    public static function log($userId, $activityType, $title, $description = null, $courseId = null, $icon = null)
    {
        return self::create([
            'user_id' => $userId,
            'course_id' => $courseId,
            'activity_type' => $activityType,
            'title' => $title,
            'description' => $description,
            'icon' => $icon ?? self::getDefaultIcon($activityType),
        ]);
    }

    /**
     * Lấy icon mặc định cho loại hoạt động
     */
    protected static function getDefaultIcon($activityType)
    {
        $icons = [
            'enrollment' => 'bi-person-plus',
            'submission' => 'bi-file-earmark-check',
            'completion' => 'bi-trophy',
            'comment' => 'bi-chat-dots',
            'lesson' => 'bi-book',
            'assignment' => 'bi-clipboard-check',
        ];

        return $icons[$activityType] ?? 'bi-activity';
    }
} 