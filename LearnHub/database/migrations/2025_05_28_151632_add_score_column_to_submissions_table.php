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
        Schema::table('submissions', function (Blueprint $table) {
            $table->float('score')->nullable()->after('file_path');
            $table->text('feedback')->nullable()->after('score');
            $table->timestamp('graded_at')->nullable()->after('feedback');
            $table->string('status')->default('submitted')->after('graded_at');
            $table->boolean('is_late')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn(['score', 'feedback', 'graded_at', 'status', 'is_late']);
        });
    }
};
