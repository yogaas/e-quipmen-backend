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
        Schema::create('journals', function (Blueprint $table) {
            $table->string('unique_code', 50)->primary();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('user_id');
            $table->date('date_created');
            $table->dateTime('time_created');
            $table->date('date_updated')->nullable();
            $table->dateTime('time_updated')->nullable();
            $table->string('type_journal');
            $table->decimal('debit', 15, 2);
            $table->decimal('credit', 15, 2);
        });

        Schema::create('journal_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->string('unique_code', 50);
            $table->decimal('debit', 15, 2);
            $table->decimal('credit', 15, 2);
            $table->string('information')->nullable();
        });

        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('code_refrensi', 50);
            $table->integer('first_balance');
            $table->unsignedBigInteger('account_id');
            $table->string('account_code');
            $table->decimal('debit', 15, 2);
            $table->decimal('credit', 15, 2);
            $table->decimal('balance', 15, 2);
            $table->string('information')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
        Schema::dropIfExists('journal_details');
        Schema::dropIfExists('ledgers');
    }
};
