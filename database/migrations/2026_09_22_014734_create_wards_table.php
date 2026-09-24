<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id();

            $table->foreignId('thana_id')
                ->constrained('thanas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unsignedInteger('ward_number');

            $table->string('name_bn');
            $table->string('name_en');

            $table->string('code')->unique();

            // Local areas under the ward
            $table->text('areas_bn')->nullable();
            $table->text('areas_en')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('thana_id');
            $table->index('ward_number');
            $table->index('is_active');

            $table->unique(
                ['thana_id', 'ward_number'],
                'wards_thana_number_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};