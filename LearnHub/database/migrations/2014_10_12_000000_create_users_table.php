<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('student'); // student, teacher, admin
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            
            // Thông tin giảng viên
            $table->string('title')->nullable(); // Chức danh
            $table->string('expertise')->nullable(); // Chuyên môn
            $table->text('experience')->nullable(); // Kinh nghiệm
            
            // Tùy chỉnh
            $table->boolean('email_notifications')->default(true);
            $table->string('language')->default('vi');
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};