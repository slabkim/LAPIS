<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanPungliCalo extends Model
{
    use HasFactory;

    protected $table = 'pengaduan_pungli_calo';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'id_user',
        'id_layanan',
        'id_kategori',
        'tanggal_kejadian',
        'nominal',
        'kronologi',
        'is_anonim',
        'status_pengaduan',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
        'nominal' => 'decimal:2',
        'is_anonim' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function layanan()
    {
        return $this->belongsTo(JenisLayanan::class, 'id_layanan');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriPengaduan::class, 'id_kategori');
    }

    public function lampiran()
    {
        return $this->hasMany(Lampiran::class, 'id_pengaduan')->where('jenis_pengaduan', 'pungli_calo');
    }
}
