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
        // Sử dụng raw SQL để thêm cột
        DB::statement('ALTER TABLE submissions ADD COLUMN IF NOT EXISTS score FLOAT NULL');
        DB::statement('ALTER TABLE submissions ADD COLUMN IF NOT EXISTS feedback TEXT NULL');
        DB::statement('ALTER TABLE submissions ADD COLUMN IF NOT EXISTS graded_at TIMESTAMP NULL');
        DB::statement('ALTER TABLE submissions ADD COLUMN IF NOT EXISTS status VARCHAR(255) DEFAULT "submitted"');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn(['score', 'feedback', 'graded_at', 'status']);
        });
    }
};
