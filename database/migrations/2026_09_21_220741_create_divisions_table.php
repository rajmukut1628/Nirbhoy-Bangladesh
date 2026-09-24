<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();

            $table->string('name_bn', 100);
            $table->string('name_en', 100);

            $table->string('code', 20)->unique();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('name_bn');
            $table->index('name_en');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};