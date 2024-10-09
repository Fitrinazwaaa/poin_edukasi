<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    protected $table='data_kelas';
    protected $primaryKey = 'angkatan_tahun';
    protected $guarded=[];
}
