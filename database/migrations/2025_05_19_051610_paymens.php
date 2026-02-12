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
        Schema::create('type_paymens', function (Blueprint $table) {
            $table->id(); // primary key auto-increment 'id'
            $table->unsignedBigInteger('owner_id');
            $table->string('paymen');
            $table->string('type_transaction');
            $table->unsignedBigInteger('account_id');
        });

        Schema::create('paymen_details', function (Blueprint $table) {
            $table->id(); // primary key auto-increment integer 'id'
            $table->string('unique_code');
            $table->unsignedBigInteger('type_paymen_id');
            $table->decimal('amount', 15, 2);
            $table->string('type_transaction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_paymens');
        Schema::dropIfExists('paymen_details');
    }
};
