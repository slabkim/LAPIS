<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPengaduan extends Model
{
    use HasFactory;

    protected $table = 'kategori_pengaduan';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false; // No timestamps in this table

    protected $fillable = [
        'nama_kategori',
    ];
}
