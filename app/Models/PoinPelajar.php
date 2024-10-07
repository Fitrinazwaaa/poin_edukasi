<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinPelajar extends Model
{
    protected $table = 'poin_pelajar';

    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'nis', 'nis');
    }
}
