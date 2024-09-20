<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    use HasFactory;

    // Jika nama tabel Anda adalah 'tabel_poin', tambahkan properti ini
    protected $table = 'poin'; // Pastikan nama tabel sudah benar
    protected $primaryKey = 'keteranganID'; // Pastikan primary key sudah sesuai

    // Kolom yang boleh diisi oleh mass assignment
    protected $fillable = [
        'keteranganID',
        'keterangan',
        'tipe',
    ];
}