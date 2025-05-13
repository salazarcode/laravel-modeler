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
        Schema::create('Relations', function (Blueprint $table) {
            $table->id('RelationId');
            $table->uuid('TenantId')->comment('FK al Tenant.');
            $table->uuid('OwnerTypeId')->comment('El Type (complejo) que posee este enlace/rol.');
            $table->string('NameRelationRole')->comment('Nombre del rol o enlace.');
            $table->uuid('TargetEntityTypeId')->comment('El Type (complejo) de la entidad referenciada.');
            $table->integer('CardinalityMin')->default(0);
            $table->integer('CardinalityMax')->default(1);
            $table->boolean('IsComposition');
            $table->unsignedBigInteger('InverseRelationId')->nullable();
            $table->string('ConceptualAssociationName')->nullable();
            $table->unique(['TenantId', 'OwnerTypeId', 'NameRelationRole'], 'idx_Tenant_OwnerType_NameRelationRole_Unique');
            $table->foreign('TenantId', 'fk_Relations_Tenants')->references('TenantId')->on('Tenants')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('OwnerTypeId', 'fk_Relations_TypesOwner')->references('TypeId')->on('Types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('TargetEntityTypeId', 'fk_Relations_TypesTarget')->references('TypeId')->on('Types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('InverseRelationId', 'fk_Relations_InverseRelation')->references('RelationId')->on('Relations')->onDelete('set null')->onUpdate('cascade');
            $table->index('TenantId', 'idx_Relations_TenantId');
            $table->index('OwnerTypeId', 'idx_Relations_OwnerTypeId');
            $table->index('TargetEntityTypeId', 'idx_Relations_TargetEntityTypeId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Relations');
    }
};
