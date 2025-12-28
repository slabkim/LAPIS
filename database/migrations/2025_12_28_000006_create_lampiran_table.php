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
        Schema::create('lampiran', function (Blueprint $table) {
            $table->id('id_lampiran');
            $table->unsignedBigInteger('id_pengaduan');
            $table->enum('jenis_pengaduan', ['pungli_calo', 'keterlambatan']);
            $table->enum('tipe_file', ['foto', 'video', 'pdf']);
            $table->string('path_file');
            $table->timestamps();
            
            // Note: Cannot add foreign key easily because id_pengaduan refers to two different tables based on jenis_pengaduan
            // We handle this via application logic or polymorphic relations if we were using a single complaints table.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampiran');
    }
};
