<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPoinPositif extends Model
{
    use HasFactory;
    
    protected $table = 'data_poin_positif';
    protected $guarded = [];
    
    protected $primaryKey = 'id_poin_positif';
    
    protected $fillable = ['nama_poin', 'poin', 'kategori_poin'];

    // Relasi yang lebih tepat, misalnya jika ada 'nis' di tabel siswa
    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'nis', 'nis'); // Asumsi bahwa relasinya menggunakan 'nis'
    }
}
