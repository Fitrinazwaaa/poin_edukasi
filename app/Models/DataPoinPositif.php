<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPoinPositif extends Model
{
    protected $table='data_poin_positif';
    protected $guarded=[];
    protected $primaryKey = 'id_poin';

    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'np', 'nis');
    }
}
