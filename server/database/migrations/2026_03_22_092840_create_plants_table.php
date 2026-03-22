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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scientific_name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('quantity')->default(1);
            $table->string('size');
            $table->string('light_requirements')->default('medium');
            $table->string('co2_requirement')->default('low');
            $table->string('difficulty_level')->default('easy');
            $table->string('growth_rate')->default('medium');
            $table->string('image_url')->nullable();
            $table->foreignId('aquarium_item_id')->nullable()->constrained('aquarium_items')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
