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
        Schema::table('pengaduan_pungli_calo', function (Blueprint $table) {
            $table->text('tanggapan_admin')->nullable()->after('status_pengaduan');
        });

        Schema::table('pengaduan_keterlambatan', function (Blueprint $table) {
            $table->text('tanggapan_admin')->nullable()->after('status_pengaduan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduan_pungli_calo', function (Blueprint $table) {
            $table->dropColumn('tanggapan_admin');
        });

        Schema::table('pengaduan_keterlambatan', function (Blueprint $table) {
            $table->dropColumn('tanggapan_admin');
        });
    }
};
