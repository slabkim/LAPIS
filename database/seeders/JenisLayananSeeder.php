<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_layanan')->insert([
            ['nama_layanan' => 'KTP Elektronik', 'status_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_layanan' => 'Kartu Keluarga', 'status_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_layanan' => 'Akta Kelahiran', 'status_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_layanan' => 'Akta Kematian', 'status_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_layanan' => 'Kartu Identitas Anak (KIA)', 'status_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_layanan' => 'Surat Pindah', 'status_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
