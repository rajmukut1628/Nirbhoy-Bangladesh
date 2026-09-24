<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('division_id')
                ->constrained('divisions')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name_bn', 100);
            $table->string('name_en', 100);

            $table->string('code', 20)->unique();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['division_id', 'is_active']);
            $table->index('name_bn');
            $table->index('name_en');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};