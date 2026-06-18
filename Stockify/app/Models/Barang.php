<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'jumlah_total',
        'jumlah_tersedia',
        'kondisi',
        'keterangan',
        'foto_barang',
    ];

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_barang', 'id_barang');
    }
}
