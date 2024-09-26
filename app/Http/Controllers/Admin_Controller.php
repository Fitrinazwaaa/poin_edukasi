<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DataSiswa; // Menggunakan model DataSiswa


class Admin_Controller extends Controller
{
    public function index()
    {
        return view('main');
    }
    public function admin()
    {
        // Mengambil semua data siswa
        $siswa = DataSiswa::all();
    
        // Mengelompokkan siswa berdasarkan tahun angkatan
        $siswaByTahun = $siswa->groupBy(function($item) {
            // Asumsikan tahun angkatan disimpan dalam kolom 'tahun_angkatan'
            return $item->tahun_angkatan;
        });
    
        // Mengirim data ke view
        return view('admin.siswa.siswa', compact('siswaByTahun'));
    }
    public function user1()
    {
        return view('user1/laporan_poin_siswa');
    }
    public function user2()
    {
        return view('user2/laporan_poin_siswa');
    }
    public function user_edit()
    {
        return view('user_edit/SiswaPoin');
    }
}
