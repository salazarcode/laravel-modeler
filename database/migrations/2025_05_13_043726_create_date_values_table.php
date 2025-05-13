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
        Schema::create('DateValues', function (Blueprint $table) {
            $table->uuid('EntityId');
            $table->unsignedBigInteger('PropertyId');
            $table->dateTime('Value')->nullable();
            $table->integer('Sequence')->default(0);
            $table->primary(['EntityId', 'PropertyId', 'Sequence']);
            $table->foreign('EntityId', 'fk_DateValues_Entities')->references('EntityId')->on('Entities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('PropertyId', 'fk_DateValues_Properties')->references('PropertyId')->on('Properties')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DateValues');
    }
};
