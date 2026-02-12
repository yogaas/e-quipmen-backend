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
        Schema::create('role_menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->text('role');
            $table->text('menus');
            $table->tinyInteger('view');
            $table->tinyInteger('create');
            $table->tinyInteger('update');
            $table->tinyInteger('delete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_menu');
    }
};
