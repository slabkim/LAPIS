<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanKeterlambatan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan_keterlambatan';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'id_user',
        'id_layanan',
        'tenggat_berkas',
        'status_pengaduan',
    ];

    protected $casts = [
        'tenggat_berkas' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function layanan()
    {
        return $this->belongsTo(JenisLayanan::class, 'id_layanan');
    }

    public function lampiran()
    {
        return $this->hasMany(Lampiran::class, 'id_pengaduan')->where('jenis_pengaduan', 'keterlambatan');
    }
}
