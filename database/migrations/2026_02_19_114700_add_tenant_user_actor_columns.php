<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table): void {
            $table->dropForeign(['created_by_user_id']);
        });

        Schema::table('jobs', function (Blueprint $table): void {
            $table->foreignId('created_by_user_id')->nullable()->change();
            $table->foreignId('created_by_tenant_user_id')
                ->nullable()
                ->after('created_by_user_id')
                ->constrained('users')
                ->nullOnDelete();
            $table->foreign('created_by_user_id')->references('id')->on('users')->nullOnDelete();
        });

        if (Schema::hasTable('revisions')) {
            Schema::table('revisions', function (Blueprint $table): void {
                $table->foreignId('actor_tenant_user_id')
                    ->nullable()
                    ->after('actor_user_id')
                    ->constrained('users')
                    ->nullOnDelete();
            });
        }

        if (Schema::hasTable('audit_logs')) {
            Schema::table('audit_logs', function (Blueprint $table): void {
                $table->foreignId('actor_tenant_user_id')
                    ->nullable()
                    ->after('actor_user_id')
                    ->constrained('users')
                    ->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('audit_logs') && Schema::hasColumn('audit_logs', 'actor_tenant_user_id')) {
            Schema::table('audit_logs', function (Blueprint $table): void {
                $table->dropForeign(['actor_tenant_user_id']);
                $table->dropColumn('actor_tenant_user_id');
            });
        }

        if (Schema::hasTable('revisions') && Schema::hasColumn('revisions', 'actor_tenant_user_id')) {
            Schema::table('revisions', function (Blueprint $table): void {
                $table->dropForeign(['actor_tenant_user_id']);
                $table->dropColumn('actor_tenant_user_id');
            });
        }

        Schema::table('jobs', function (Blueprint $table): void {
            $table->dropForeign(['created_by_user_id']);
            $table->dropForeign(['created_by_tenant_user_id']);
            $table->dropColumn('created_by_tenant_user_id');
            $table->foreignId('created_by_user_id')->nullable(false)->change();
            $table->foreign('created_by_user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
};
