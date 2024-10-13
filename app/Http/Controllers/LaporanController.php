<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoinPelajar;

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil data dari tabel poin_pelajar
        $poinPelajar = PoinPelajar::all();

        // Kirim data ke view
        return view('admin.laporan.laporan_poin_siswa', ['poinPelajar' => $poinPelajar]);
    }

}

