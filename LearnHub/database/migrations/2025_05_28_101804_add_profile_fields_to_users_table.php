<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm các trường thông tin cá nhân nếu chưa tồn tại
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'birthday')) {
                $table->date('birthday')->nullable();
            }
            
            // Thêm các trường thông tin giảng viên
            if (!Schema::hasColumn('users', 'title')) {
                $table->string('title')->nullable(); // Chức danh
            }
            
            if (!Schema::hasColumn('users', 'expertise')) {
                $table->string('expertise')->nullable(); // Chuyên môn
            }
            
            if (!Schema::hasColumn('users', 'experience')) {
                $table->text('experience')->nullable(); // Kinh nghiệm
            }
            
            // Thêm các trường tùy chỉnh
            if (!Schema::hasColumn('users', 'email_notifications')) {
                $table->boolean('email_notifications')->default(true);
            }
            
            if (!Schema::hasColumn('users', 'language')) {
                $table->string('language')->default('vi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'phone',
                'birthday',
                'title',
                'expertise',
                'experience',
                'email_notifications',
                'language'
            ]);
        });
    }
};
