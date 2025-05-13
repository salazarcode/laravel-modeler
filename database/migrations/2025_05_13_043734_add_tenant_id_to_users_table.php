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
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->uuid('TenantId')->nullable()->after('id')->comment('El Tenant al que pertenece el usuario. NULL para superadmin.');
                $table->foreign('TenantId', 'fk_Users_Tenants')->references('TenantId')->on('Tenants')->onDelete('set null')->onUpdate('cascade');
                $table->index('TenantId', 'idx_Users_TenantId');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'TenantId')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign('fk_Users_Tenants');
                $table->dropIndex('idx_Users_TenantId');
                $table->dropColumn('TenantId');
            });
        }
    }
};
