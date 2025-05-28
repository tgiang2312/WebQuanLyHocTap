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
        Schema::table('assignments', function (Blueprint $table) {
            if (!Schema::hasColumn('assignments', 'course_id')) {
                $table->foreignId('course_id')->after('lesson_id')->nullable()->constrained('courses')->onDelete('cascade');
            }
        });

        // Cập nhật course_id cho các assignment hiện có
        DB::statement('UPDATE assignments SET course_id = (SELECT lessons.course_id FROM lessons WHERE lessons.id = assignments.lesson_id)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            if (Schema::hasColumn('assignments', 'course_id')) {
                $table->dropForeign(['course_id']);
                $table->dropColumn('course_id');
            }
        });
    }
};
