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
        Schema::create('ReferencesValues', function (Blueprint $table) {
            $table->uuid('OwnerEntityId');
            $table->unsignedBigInteger('RelationId');
            $table->uuid('ReferencedEntityId');
            $table->integer('Sequence')->default(0);
            $table->primary(['OwnerEntityId', 'RelationId', 'Sequence']);
            $table->foreign('OwnerEntityId', 'fk_ReferencesValues_EntitiesOwner')->references('EntityId')->on('Entities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('RelationId', 'fk_ReferencesValues_Relations')->references('RelationId')->on('Relations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ReferencedEntityId', 'fk_ReferencesValues_EntitiesReferenced')->references('EntityId')->on('Entities')->onDelete('restrict')->onUpdate('cascade');
            $table->index('ReferencedEntityId', 'idx_ReferencesValues_ReferencedEntityId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ReferencesValues');
    }
};
