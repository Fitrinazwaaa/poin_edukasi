<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    protected $table='data_siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded=[];
    
    public function poin()
    {
        return $this->hasOne(PoinPelajar::class, 'nis', 'nis');
    }

    // Definisikan relasi ke PoinPelajar
    public function poinPelajar()
    {
        return $this->hasMany(PoinPelajar::class, 'nis', 'nis');
    }

    // Relasi ke PoinPositif
    public function poinPositif()
    {
        return $this->hasMany(DataPoinPositif::class, 'np', 'nis'); // Mengaitkan 'np' di tabel poin positif dengan 'nis' di tabel data siswa
    }

    // Relasi ke PoinNegatif
    public function poinNegatif()
    {
        return $this->hasMany(DataPoinNegatif::class, 'np', 'nis'); // Mengaitkan 'np' di tabel poin negatif dengan 'nis' di tabel data siswa
    }
}