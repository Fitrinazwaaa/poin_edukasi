<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPoinNegatif extends Model
{
    protected $table='data_poin_negatif';
    protected $guarded=[];
    protected $primaryKey = 'id_poin';


    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'np', 'nis');
    }
}
