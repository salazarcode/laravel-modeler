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
        Schema::create('Properties', function (Blueprint $table) {
            $table->id('PropertyId');
            $table->uuid('TenantId')->comment('FK al Tenant.');
            $table->uuid('OwnerTypeId')->comment('El Type (complejo) al que pertenece esta propiedad.');
            $table->string('NameProperty')->comment('Nombre legible de la propiedad.');
            $table->uuid('DataTypeId')->comment('El Type del dato del valor. Types.IsPrimitive debe ser TRUE.');
            $table->integer('CardinalityMin')->default(1)->comment('Cardinalidad mínima.');
            $table->integer('CardinalityMax')->default(1)->comment('Cardinalidad máxima (-1 para ilimitado).');
            $table->unique(['TenantId', 'OwnerTypeId', 'NameProperty'], 'idx_Tenant_OwnerType_NameProperty_Unique');
            $table->foreign('TenantId', 'fk_Properties_Tenants')->references('TenantId')->on('Tenants')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('OwnerTypeId', 'fk_Properties_TypesOwner')->references('TypeId')->on('Types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('DataTypeId', 'fk_Properties_TypesData')->references('TypeId')->on('Types')->onDelete('restrict')->onUpdate('cascade');
            $table->index('TenantId', 'idx_Properties_TenantId');
            $table->index('OwnerTypeId', 'idx_Properties_OwnerTypeId');
            $table->index('DataTypeId', 'idx_Properties_DataTypeId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Properties');
    }
};
