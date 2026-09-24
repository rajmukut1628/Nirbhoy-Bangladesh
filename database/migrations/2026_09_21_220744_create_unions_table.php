<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('upazila_id')
                ->constrained('upazilas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name_bn', 150);
            $table->string('name_en', 150);

            $table->string('code', 50)->unique();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['upazila_id', 'is_active']);
            $table->index('name_bn');
            $table->index('name_en');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unions');
    }
};