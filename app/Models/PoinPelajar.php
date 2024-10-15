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
    protected $fillable = [
        'nis', 'nama', 'jenis_kelamin', 'kelas', 'jurusan',
        'positif_poin', 'negatif_poin', 'keterangan_positif',
        'keterangan_negatif', 'tanggal_positif', 'tanggal_negatif'
    ];

    // Jika 'keterangan_negatif' dan 'tanggal_negatif' adalah array
    protected $casts = [
        'keterangan_negatif' => 'array',
        'tanggal_negatif' => 'array',
    ];
    
}

