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
            if (!Schema::hasColumn('submissions', 'score')) {
                $table->float('score')->nullable();
            }
            if (!Schema::hasColumn('submissions', 'feedback')) {
                $table->text('feedback')->nullable();
            }
            if (!Schema::hasColumn('submissions', 'graded_at')) {
                $table->timestamp('graded_at')->nullable();
            }
            if (!Schema::hasColumn('submissions', 'status')) {
                $table->string('status')->default('submitted');
            }
        });
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
