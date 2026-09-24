<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('thana_id')
                ->constrained('thanas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Ward জানা থাকলে link হবে, না থাকলে NULL
            $table->foreignId('ward_id')
                ->nullable()
                ->constrained('wards')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('name_bn');
            $table->string('name_en');

            $table->string('code')->unique();

            // Alternative/local spellings
            $table->string('alias_bn')->nullable();
            $table->string('alias_en')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('thana_id');
            $table->index('ward_id');
            $table->index('name_bn');
            $table->index('name_en');

            $table->unique(
                ['thana_id', 'name_en'],
                'areas_thana_name_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};