<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | User Role
            |--------------------------------------------------------------------------
            |
            | user
            | moderator
            | senior_moderator
            | admin
            |
            */

            $table->enum('role', [
                'user',
                'moderator',
                'senior_moderator',
                'admin',
            ])->default('user')->after('password');

            /*
            |--------------------------------------------------------------------------
            | Location
            |--------------------------------------------------------------------------
            */

            $table->foreignId('division_id')
                ->nullable()
                ->after('role')
                ->constrained('divisions')
                ->nullOnDelete();

            $table->foreignId('district_id')
                ->nullable()
                ->after('division_id')
                ->constrained('districts')
                ->nullOnDelete();

            $table->foreignId('upazila_id')
                ->nullable()
                ->after('district_id')
                ->constrained('upazilas')
                ->nullOnDelete();

            $table->foreignId('union_id')
                ->nullable()
                ->after('upazila_id')
                ->constrained('unions')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Language
            |--------------------------------------------------------------------------
            */

            $table->enum('preferred_language', [
                'bn',
                'en',
            ])->default('bn')->after('union_id');

            /*
            |--------------------------------------------------------------------------
            | Account Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'active',
                'suspended',
                'blocked',
            ])->default('active')->after('preferred_language');

            /*
            |--------------------------------------------------------------------------
            | Security / Moderation
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_verified')
                ->default(false)
                ->after('status');

            $table->timestamp('suspended_until')
                ->nullable()
                ->after('is_verified');

            $table->text('blocked_reason')
                ->nullable()
                ->after('suspended_until');

            $table->timestamp('last_login_at')
                ->nullable()
                ->after('blocked_reason');

            $table->string('last_login_ip', 45)
                ->nullable()
                ->after('last_login_at');

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('role');
            $table->index('status');

            $table->index([
                'district_id',
                'status',
            ]);

            $table->index([
                'role',
                'status',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropIndex(['role']);
            $table->dropIndex(['status']);
            $table->dropIndex(['district_id', 'status']);
            $table->dropIndex(['role', 'status']);

            $table->dropForeign(['union_id']);
            $table->dropForeign(['upazila_id']);
            $table->dropForeign(['district_id']);
            $table->dropForeign(['division_id']);

            $table->dropColumn([
                'role',
                'division_id',
                'district_id',
                'upazila_id',
                'union_id',
                'preferred_language',
                'status',
                'is_verified',
                'suspended_until',
                'blocked_reason',
                'last_login_at',
                'last_login_ip',
            ]);
        });
    }
};