<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_evidence', function (Blueprint $table) {
            $table->id();

            $table->foreignId('report_id')
                ->constrained('reports')
                ->cascadeOnDelete();

            $table->enum('type', [
                'image',
                'video',
                'audio',
                'document',
                'other',
            ]);

            /*
             * Actual evidence will later be stored privately,
             * not directly inside /public.
             */
            $table->string('file_path');
            $table->string('original_name')->nullable();
            $table->string('mime_type', 150)->nullable();

            $table->unsignedBigInteger('file_size')->nullable();

            // Exact duplicate detection
            $table->string('sha256_hash', 64)->nullable();

            // Later used for visually similar image detection
            $table->string('perceptual_hash', 255)->nullable();

            $table->boolean('is_verified')->default(false);
            $table->boolean('is_public')->default(false);

            $table->text('admin_note')->nullable();

            $table->timestamps();

            $table->index('report_id');
            $table->index('sha256_hash');
            $table->index('is_verified');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_evidence');
    }
};