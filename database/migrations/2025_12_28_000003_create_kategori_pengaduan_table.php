<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_pengaduan', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori', 50);
        });

        // Seed default categories
        DB::table('kategori_pengaduan')->insert([
            ['nama_kategori' => 'Pungli'],
            ['nama_kategori' => 'Calo'],
            ['nama_kategori' => 'Keterlambatan Berkas'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_pengaduan');
    }
};
