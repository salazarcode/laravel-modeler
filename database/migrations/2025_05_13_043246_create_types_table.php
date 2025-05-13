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
        Schema::create('Types', function (Blueprint $table) {
            $table->uuid('TypeId')->primary();
            $table->uuid('TenantId')->comment('FK al Tenant al que pertenece esta definición de Tipo.');
            $table->string('NameType')->comment('Nombre legible del tipo.');
            $table->boolean('IsPrimitive')->comment('TRUE si es un tipo primitivo, FALSE si es un tipo complejo/entidad.');
            $table->string('PrimitiveValueTableName', 100)->nullable()->comment('Si IsPrimitive = TRUE, indica el nombre de la tabla de valores específica.');
            $table->unique(['TenantId', 'NameType'], 'idx_Tenant_NameType_Unique');
            $table->foreign('TenantId', 'fk_Types_Tenants')->references('TenantId')->on('Tenants')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Types');
    }
};
