<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('report_id')
                ->constrained('reports')
                ->cascadeOnDelete();

            $table->foreignId('admin_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->enum('action', [
                'opened',
                'under_review',
                'approved',
                'rejected',
                'marked_duplicate',
                'edited',
                'published',
                'unpublished',
                'hot_list_added',
                'hot_list_removed',
                'archived',
                'restored',
            ]);

            $table->string('previous_status', 50)->nullable();
            $table->string('new_status', 50)->nullable();

            $table->text('note')->nullable();

            // Internal audit information
            $table->string('ip_address', 45)->nullable();

            $table->timestamps();

            $table->index('report_id');
            $table->index('admin_id');
            $table->index('action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_reviews');
    }
};