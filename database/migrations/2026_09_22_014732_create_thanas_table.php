<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('thanas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('district_id')
                ->constrained('districts')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name_bn');
            $table->string('name_en');

            $table->string('code')->unique();

            // Example: DNCC / DSCC
            $table->string('city_corporation_code')->nullable();

            $table->boolean('is_metropolitan')->default(true);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('district_id');
            $table->index('city_corporation_code');
            $table->index('is_active');

            $table->unique(
                ['district_id', 'name_en'],
                'thanas_district_name_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thanas');
    }
};