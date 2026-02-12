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
        Schema::create('sections', function (Blueprint $table) {
            $table->id(); // primary key auto-increment integer 'id'
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('account_id');
            $table->string('name');
            $table->string('tag');
            $table->tinyInteger('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
