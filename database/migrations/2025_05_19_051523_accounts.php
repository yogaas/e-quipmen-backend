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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id(); // primary key auto-increment 'id'
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('id_parent')->nullable();
            $table->string('code_account', 50);
            $table->string('name_account', 100);
            $table->integer('level');
            $table->tinyInteger('header');
            $table->string('normal_pos');
            $table->string('grouper');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
