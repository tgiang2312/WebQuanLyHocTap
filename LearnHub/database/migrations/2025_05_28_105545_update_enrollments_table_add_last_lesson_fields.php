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
        Schema::table('enrollments', function (Blueprint $table) {
            $table->unsignedBigInteger('last_lesson_id')->nullable()->after('progress');
            $table->string('last_lesson_title')->nullable()->after('last_lesson_id');
            $table->boolean('completed')->default(false)->after('progress');
            
            $table->foreign('last_lesson_id')->references('id')->on('lessons')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropForeign(['last_lesson_id']);
            $table->dropColumn(['last_lesson_id', 'last_lesson_title', 'completed']);
        });
    }
};
