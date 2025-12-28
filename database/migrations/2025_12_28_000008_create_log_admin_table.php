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
        Schema::create('log_admin', function (Blueprint $table) {
            $table->id('id_log');
            $table->unsignedBigInteger('id_admin');
            $table->string('aktivitas');
            $table->dateTime('waktu_aktivitas')->useCurrent();
            
            $table->foreign('id_admin')->references('id_admin')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_admin');
    }
};
