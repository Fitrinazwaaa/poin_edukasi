<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    protected $table='data_kelas';
    protected $guarded=[];
    // protected $fillable = ['tahun_angkatan', 'jurusan', 'jurusan_ke'];
        /**
     * Kolom yang dapat diisi menggunakan mass assignment
     */
    protected $fillable = [
        'id',
        'tahun_angkatan',
        'jurusan',
        'jurusan_ke',
        'created_at',
        'updated_at',
    ];
}
