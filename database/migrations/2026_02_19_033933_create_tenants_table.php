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
        Schema::create('tenants', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('db_host');
            $table->unsignedSmallInteger('db_port')->default(3306);
            $table->string('db_name');
            $table->string('db_user');
            $table->text('db_password');
            $table->string('db_prefix')->default('ps_');
            $table->string('base_shop_url');
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::table('jobs', function (Blueprint $table): void {
            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table): void {
            $table->dropForeign(['tenant_id']);
        });

        Schema::dropIfExists('tenants');
    }
};
