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
        Schema::create('sales', function (Blueprint $table) {
            $table->string('unique_code')->primary();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('customer_id');
            $table->date('date_created');
            $table->dateTime('time_created');
            $table->decimal('sub_total', 15, 2);
            $table->float('percen_ppn');
            $table->float('percen_discount');
            $table->decimal('price_ppn', 15, 2);
            $table->decimal('price_discount', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->tinyInteger('status_paymen');
            $table->tinyInteger('status_cancel');
            $table->tinyInteger('status_jurnal');
            $table->tinyInteger('status_closebook');
            $table->string('user_create'); 
        });

        Schema::create('sales_details', function (Blueprint $table) {
            $table->id(); // primary key auto-increment integer 'id'
            $table->string('unique_code');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('item_id');
            $table->string('unit');
            $table->decimal('price', 15, 2);
            $table->float('qty');
            $table->decimal('amount', 15, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
        Schema::dropIfExists('sales_details');
    }
};
