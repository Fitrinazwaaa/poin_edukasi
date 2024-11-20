<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPoinNegatif extends Model
{
    use HasFactory;
    
    protected $table = 'data_poin_negatif';
    protected $guarded = [];
    
    protected $primaryKey = 'id_poin_negatif';
    
    protected $fillable = ['nama_poin', 'poin', 'kategori_poin'];
    // protected $fillable = ['nama_poin', 'id_poin_negatif', 'poin', 'kategori_poin'];

    // Relasi yang lebih tepat, misalnya jika ada 'nis' di tabel siswa
    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'nis', 'nis'); // Asumsi bahwa relasinya menggunakan 'nis'
    }
}
