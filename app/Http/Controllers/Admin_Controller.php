<?php

namespace App\Http\Controllers;

use App\Models\PoinPelajar;
use App\Models\PoinPeringatan;
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
        return view('admin/laporan/laporan_poin_siswa');
    }
    public function user2()
    {
        return view('admin/laporan/laporan_poin_siswa');
    }
    public function user_edit()
    {
        // Mengambil data siswa dari tabel poin_pelajar yang sudah menyimpan total poin positif dan negatif
        $dataSiswa = PoinPelajar::all();
        
    
        // Mengambil poin peringatan
        $poinPeringatans = PoinPeringatan::whereIn('id_peringatan', range(1, 8))->get();
    
        // Memastikan bahwa semua poin peringatan ditemukan
        if ($poinPeringatans->count() < 8) {
            return redirect()->back()->with('error', 'Poin peringatan tidak ditemukan.');
        }
    
        // Menghitung jumlah notifikasi untuk setiap kategori
        $jumlahNotifikasi = [];
        foreach ($poinPeringatans as $index => $poinPeringatan) {
            $nextPoin = isset($poinPeringatans[$index + 1]) ? $poinPeringatans[$index + 1]->max_poin : null;
            $maxPoin = $poinPeringatan->max_poin;
    
            if ($nextPoin) {
                $jumlahNotifikasi[] = PoinPelajar::whereBetween('poin_negatif', [$maxPoin, $nextPoin])->count();
            } else {
                $jumlahNotifikasi[] = PoinPelajar::where('poin_negatif', '>', $maxPoin)->count();
            }
        }
    
        // Mengirim data siswa dan jumlah notifikasi ke view
        return view('admin.poin_siswa.SiswaPoin', compact('dataSiswa', 'jumlahNotifikasi'));
    }
    
}
