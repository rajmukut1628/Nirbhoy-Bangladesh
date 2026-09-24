<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->string('tracking_code', 40)->unique();

            // Linked only after/when admin identifies the accused profile.
            $table->foreignId('accused_id')
                ->nullable()
                ->constrained('accuseds')
                ->nullOnDelete();

            $table->string('accused_name', 255);
            $table->string('accused_alias', 255)->nullable();
            $table->string('accused_phone', 30)->nullable();
            $table->string('accused_organization', 255)->nullable();

            $table->foreignId('division_id')
                ->nullable()
                ->constrained('divisions')
                ->nullOnDelete();

            $table->foreignId('district_id')
                ->constrained('districts')
                ->restrictOnDelete();

            $table->foreignId('upazila_id')
                ->nullable()
                ->constrained('upazilas')
                ->nullOnDelete();

            $table->foreignId('union_id')
                ->nullable()
                ->constrained('unions')
                ->nullOnDelete();

            $table->string('incident_area', 255)->nullable();

            $table->date('incident_date')->nullable();
            $table->time('incident_time')->nullable();

            $table->decimal('amount_demanded', 15, 2)->nullable();
            $table->decimal('amount_paid', 15, 2)->nullable();

            $table->text('description');

            /*
             * Reporter details are private and never displayed publicly.
             * They are optional so anonymous reporting remains possible.
             */
            $table->string('reporter_name', 255)->nullable();
            $table->string('reporter_phone', 30)->nullable();
            $table->string('reporter_email', 255)->nullable();

            $table->boolean('is_anonymous')->default(true);

            $table->enum('status', [
                'pending',
                'under_review',
                'approved',
                'rejected',
                'duplicate',
                'archived',
            ])->default('pending');

            $table->text('admin_note')->nullable();
            $table->text('rejection_reason')->nullable();

            /*
             * Internal anti-abuse / duplicate-detection metadata.
             * Never show these publicly.
             */
            $table->string('submission_ip_hash', 64)->nullable();
            $table->string('content_hash', 64)->nullable();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('accused_id');
            $table->index('content_hash');

            $table->index([
                'district_id',
                'upazila_id',
                'union_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};