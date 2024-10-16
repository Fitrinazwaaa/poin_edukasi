<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinPelajar extends Model
{
    use HasFactory;

    // Tentukan tabel jika namanya tidak sesuai konvensi Laravel
    protected $table = 'poin_pelajar';

    // Tentukan kolom yang dapat diisi
    protected $fillable = ['nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'poin_positif', 'poin_negatif', 'nama_poin_positif','nama_poin_negatif', 'tanggal_positif', 'tanggal_negatif'];

    // Jika 'keterangan_negatif' dan 'tanggal_negatif' adalah array
    protected $casts = [
        'nama_poin_negatif' => 'array',
        'tanggal_negatif' => 'array',
    ];
    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'nis', 'nis');
    }   
}

