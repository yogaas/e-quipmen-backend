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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->foreignId('user_id');
            $table->string('activity'); // deskripsi aktivitas
            $table->ipAddress('ip_address')->nullable(); // alamat IP
            $table->text('user_agent')->nullable(); // user agent (browser, OS, dll)
            $table->text('primary_key')->nullable(); // key
            $table->text('action')->nullable(); // action (CREATE, UPDATE, DELETE)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
