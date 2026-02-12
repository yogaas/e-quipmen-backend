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
        Schema::create('items', function (Blueprint $table) {
            $table->id(); // primary key integer auto-increment 'id'
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('section_id');
            $table->string('name');
            $table->string('unit_purchase');
            $table->string('unit_sale');
            $table->decimal('price_purchase', 15, 2);
            $table->decimal('price_sale', 15, 2);
            $table->integer('minimum_stock');
            $table->string('img_items')->nullable();
            $table->tinyInteger('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
