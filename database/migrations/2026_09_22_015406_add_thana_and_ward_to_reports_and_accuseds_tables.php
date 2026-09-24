<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->foreignId('thana_id')
                ->nullable()
                ->after('union_id')
                ->constrained('thanas')
                ->nullOnDelete();

            $table->foreignId('ward_id')
                ->nullable()
                ->after('thana_id')
                ->constrained('wards')
                ->nullOnDelete();

            $table->index(['thana_id', 'ward_id']);
        });

        Schema::table('accuseds', function (Blueprint $table) {
            $table->foreignId('thana_id')
                ->nullable()
                ->after('union_id')
                ->constrained('thanas')
                ->nullOnDelete();

            $table->foreignId('ward_id')
                ->nullable()
                ->after('thana_id')
                ->constrained('wards')
                ->nullOnDelete();

            $table->index(['thana_id', 'ward_id']);
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['ward_id']);
            $table->dropForeign(['thana_id']);

            $table->dropIndex(['thana_id', 'ward_id']);

            $table->dropColumn([
                'ward_id',
                'thana_id',
            ]);
        });

        Schema::table('accuseds', function (Blueprint $table) {
            $table->dropForeign(['ward_id']);
            $table->dropForeign(['thana_id']);

            $table->dropIndex(['thana_id', 'ward_id']);

            $table->dropColumn([
                'ward_id',
                'thana_id',
            ]);
        });
    }
};