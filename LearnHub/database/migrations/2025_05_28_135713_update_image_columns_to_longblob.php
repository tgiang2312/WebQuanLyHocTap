<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Thay đổi cột image trong bảng courses thành LONGBLOB
        Schema::table('courses', function (Blueprint $table) {
            // Đầu tiên tạo cột mới để lưu dữ liệu binary
            $table->binary('image_data')->nullable()->after('image');
        });

        // Thay đổi cột avatar trong bảng users thành LONGBLOB
        Schema::table('users', function (Blueprint $table) {
            // Đầu tiên tạo cột mới để lưu dữ liệu binary
            $table->binary('avatar_data')->nullable()->after('avatar');
        });
        
        // Cần sử dụng DB::statement để thay đổi kiểu dữ liệu thành LONGBLOB vì Laravel không hỗ trợ trực tiếp
        DB::statement('ALTER TABLE courses MODIFY image_data LONGBLOB');
        DB::statement('ALTER TABLE users MODIFY avatar_data LONGBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Xóa cột image_data trong bảng courses
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('image_data');
        });

        // Xóa cột avatar_data trong bảng users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar_data');
        });
    }
};
