<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accuseds', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->string('alias', 255)->nullable();
            $table->string('photo')->nullable();

            $table->string('phone', 30)->nullable();
            $table->string('organization', 255)->nullable();
            $table->string('occupation', 255)->nullable();

            $table->foreignId('division_id')
                ->nullable()
                ->constrained('divisions')
                ->nullOnDelete();

            $table->foreignId('district_id')
                ->nullable()
                ->constrained('districts')
                ->nullOnDelete();

            $table->foreignId('upazila_id')
                ->nullable()
                ->constrained('upazilas')
                ->nullOnDelete();

            $table->foreignId('union_id')
                ->nullable()
                ->constrained('unions')
                ->nullOnDelete();

            $table->string('area', 255)->nullable();

            $table->text('description')->nullable();

            // Only reviewed/approved profiles should be public.
            $table->enum('verification_status', [
                'pending',
                'under_review',
                'approved',
                'rejected',
                'disputed',
            ])->default('pending');

            // Admin controls whether approved profile is visible.
            $table->boolean('is_public')->default(false);

            // Admin-selected Hot List.
            $table->boolean('is_hot')->default(false);
            $table->unsignedInteger('hot_order')->nullable();

            $table->timestamp('verified_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('verification_status');
            $table->index('is_public');
            $table->index('is_hot');

            $table->index([
                'district_id',
                'upazila_id',
                'union_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accuseds');
    }
};