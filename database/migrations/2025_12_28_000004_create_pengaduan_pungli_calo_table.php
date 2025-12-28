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
        Schema::create('pengaduan_pungli_calo', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->unsignedBigInteger('id_user')->nullable(); // Nullable for anonymous
            $table->unsignedBigInteger('id_layanan');
            $table->unsignedBigInteger('id_kategori');
            $table->date('tanggal_kejadian');
            $table->decimal('nominal', 12, 2)->nullable();
            $table->text('kronologi');
            $table->boolean('is_anonim')->default(false);
            $table->string('status_pengaduan', 50)->default('Menunggu Konfirmasi');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_layanan')->references('id_layanan')->on('jenis_layanan');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_pengaduan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan_pungli_calo');
    }
};
