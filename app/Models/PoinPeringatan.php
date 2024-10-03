<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinPeringatan extends Model
{
    protected $table = 'data_poin_peringatan'; // Pastikan ini benar
    protected $primaryKey = 'id_peringatan'; // Primary key sesuai dengan migration
}
