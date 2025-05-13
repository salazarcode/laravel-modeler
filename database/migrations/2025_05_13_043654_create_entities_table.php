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
        Schema::create('Entities', function (Blueprint $table) {
            $table->uuid('EntityId')->primary();
            $table->uuid('TenantId')->comment('FK al Tenant al que pertenece esta Entidad.');
            $table->uuid('TypeId')->comment('Indica de qué tipo es esta entidad (FK a Types.TypeId).');
            $table->timestamps();
            $table->foreign('TenantId', 'fk_Entities_Tenants')->references('TenantId')->on('Tenants')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('TypeId', 'fk_Entities_Types')->references('TypeId')->on('Types')->onDelete('restrict')->onUpdate('cascade');
            $table->index('TenantId', 'idx_Entities_TenantId');
            $table->index('TypeId', 'idx_Entities_TypeId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Entities');
    }
};
