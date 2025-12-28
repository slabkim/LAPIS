<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    use HasFactory;

    protected $table = 'survei';
    protected $primaryKey = 'id_survei';

    protected $fillable = [
        'id_user',
        'id_layanan',
        'nilai_informasi',
        'nilai_kecepatan',
        'nilai_sikap',
        'nilai_prosedur',
        'nilai_rata_rata',
        'komentar',
    ];

    protected $casts = [
        'nilai_rata_rata' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function layanan()
    {
        return $this->belongsTo(JenisLayanan::class, 'id_layanan');
    }
}
