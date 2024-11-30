<?php

namespace App\Http\Controllers;

use App\Models\DataKelas;
use App\Models\DataPoinNegatif;
use App\Models\DataPoinPositif;
use App\Models\PoinPelajar;
use App\Models\PoinPeringatan;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DataSiswa; // Menggunakan model DataSiswa
use App\Models\DataUser;

class Admin_Controller extends Controller
{
    public function index()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();

        // Mengambil semua data siswa
        $siswa = DataSiswa::all();
    
        // Mengelompokkan siswa berdasarkan tahun angkatan
        $siswaByTahun = $siswa->groupBy(function($item) {
            // Asumsikan tahun angkatan disimpan dalam kolom 'tahun_angkatan'
            return $item->tahun_angkatan;
        });

        $tahun_angkatan = DataKelas::select('tahun_angkatan')->distinct()->get(); 
        $data_kelas = DataKelas::all(); // Mengambil semua data dari tabel data_kelas
    
        // Mengirim data ke view
        return view('admin.siswa.siswa', compact('siswaByTahun', 'tahun_angkatan', 'data_kelas', 'datauser'));
    }
    
    public function user1()
    {
        // Ambil data dari tabel poin_pelajar
        $poinPelajar = PoinPelajar::all();

        // Kirim data ke view
        return view('admin.laporan.laporan_poin_siswa', ['poinPelajar' => $poinPelajar]);
    }
    public function user2()
    {
        // Ambil data dari tabel poin_pelajar
        $poinPelajar = PoinPelajar::all();

        // Kirim data ke view
        return view('admin.laporan.laporan_poin_siswa', ['poinPelajar' => $poinPelajar]);
    }
    public function user_edit()
    {
        $poinPeringatan1 = PoinPeringatan::where('id_peringatan', '1')->first(); // Ambil satu data dengan first()
        $poinPeringatan2 = PoinPeringatan::where('id_peringatan', '2')->first(); // Ambil satu data dengan first()
        $poinPeringatan3 = PoinPeringatan::where('id_peringatan', '3')->first(); // Ambil satu data dengan first()
        $poinPeringatan4 = PoinPeringatan::where('id_peringatan', '4')->first(); // Ambil satu data dengan first()
        $poinPeringatan5 = PoinPeringatan::where('id_peringatan', '5')->first(); // Ambil satu data dengan first()
        $poinPeringatan6 = PoinPeringatan::where('id_peringatan', '6')->first(); // Ambil satu data dengan first()
        $poinPeringatan7 = PoinPeringatan::where('id_peringatan', '7')->first(); // Ambil satu data dengan first()
        $poinPeringatan8 = PoinPeringatan::where('id_peringatan', '8')->first(); // Ambil satu data dengan first()
        // Mengelompokkan data siswa berdasarkan NIS dan menghitung total poin positif dan negatif
        $dataSiswa = PoinPelajar::select(
            'nis', 
            'nama', 
            'jenis_kelamin', 
            'tingkatan', 
            'jurusan', 
            'jurusan_ke',
            DB::raw('SUM(poin_positif) as jumlah_positif'), // Menghitung total poin positif
            DB::raw('SUM(poin_negatif) as jumlah_negatif')  // Menghitung total poin negatif
        )
        ->groupBy('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke')
        ->get();

        // Perhitungan sisa poin positif dan negatif
        foreach ($dataSiswa as $siswa) {
            if ($siswa->jumlah_positif > $siswa->jumlah_negatif) {
                // Jika poin positif lebih besar, sisa poin positif
                $siswa->poin_positif_akhir = $siswa->jumlah_positif - $siswa->jumlah_negatif;
                $siswa->poin_negatif_akhir = 0;
            } else {
                // Jika poin negatif lebih besar atau sama, sisa poin negatif
                $siswa->poin_negatif_akhir = $siswa->jumlah_negatif - $siswa->jumlah_positif;
                $siswa->poin_positif_akhir = 0;
            }

            // Update kolom jumlah_positif dan jumlah_negatif
            PoinPelajar::where('nis', $siswa->nis)
                ->update([
                    'jumlah_positif' => $siswa->poin_positif_akhir,
                    'jumlah_negatif' => $siswa->poin_negatif_akhir
                ]);
        }

        // Mengambil poin peringatan
        $poinPeringatans = PoinPeringatan::whereIn('id_peringatan', range(1, 8))->get();

        // Memastikan bahwa semua poin peringatan ditemukan
        if ($poinPeringatans->count() < 8) {
            return redirect()->back()->with('error', 'Poin peringatan tidak ditemukan.');
        }

        $tingkatanList = DB::table('data_siswa')->distinct()->pluck('tingkatan');


        // Menghitung jumlah notifikasi untuk setiap kategori berdasarkan NIS
        $jumlahNotifikasi = [];
        foreach ($poinPeringatans as $index => $poinPeringatan) {
            $nextPoin = isset($poinPeringatans[$index + 1]) ? $poinPeringatans[$index + 1]->max_poin : null;
            $maxPoin = $poinPeringatan->max_poin;

            if ($nextPoin) {
                // Menghitung jumlah siswa unik (berdasarkan NIS) dengan poin negatif antara maxPoin dan nextPoin
                $jumlahNotifikasi[] = PoinPelajar::select('nis')
                                                ->where('jumlah_negatif', '>', $maxPoin)
                                                ->where('jumlah_negatif', '<=', $nextPoin)
                                                ->groupBy('nis') // Hanya hitung siswa unik berdasarkan NIS
                                                ->get()->count();
            } else {
                // Menghitung siswa yang memiliki poin negatif lebih dari maxPoin pada poin peringatan terakhir
                $jumlahNotifikasi[] = PoinPelajar::select('nis')
                                                ->where('jumlah_negatif', '>', $maxPoin)
                                                ->groupBy('nis') // Hanya hitung siswa unik berdasarkan NIS
                                                ->get()->count();
            }
        }

        // Mengirim data siswa dan jumlah notifikasi ke view
        return view('admin.poin_siswa.SiswaPoin', compact('dataSiswa', 'jumlahNotifikasi', 'tingkatanList', 'poinPeringatan1', 'poinPeringatan2', 'poinPeringatan3', 'poinPeringatan4', 'poinPeringatan5', 'poinPeringatan6', 'poinPeringatan7', 'poinPeringatan8'));
    }

    
    public function getJurusan($tingkatan)
    {
        // Mengambil jurusan yang unik berdasarkan tingkatan
        $jurusan = DB::table('data_siswa')
        ->where('tingkatan', $tingkatan)
        ->distinct()
        ->pluck('jurusan'); // Hanya mengambil jurusan yang unik
        
        return response()->json($jurusan);
    }
    
    public function getJurusanKe($jurusan)
    {
        // Mengambil jurusan_ke yang unik berdasarkan jurusan
        $jurusanKeList = DB::table('data_siswa')
        ->where('jurusan', $jurusan)
                         ->distinct()
                         ->pluck('jurusan_ke'); // Mengambil jurusan_ke yang unik
        
                         // Mengembalikan hasil dalam bentuk array objek agar dapat digunakan di dropdown
                         $result = $jurusanKeList->map(function ($jurusanKe) {
                             return ['jurusan_ke' => $jurusanKe];
        });
        
        return response()->json($result);
    }
    
    public function searchNamaPoinSiswa(Request $request)
    {
        $siswaList = DataSiswa::where('tingkatan', $request->tingkatan)
        ->where('jurusan', $request->jurusan)
        ->where('jurusan_ke', $request->jurusan_ke)
        ->get(['nis', 'nama']); // Mendapatkan nis dan nama siswa
        
        return response()->json($siswaList);
    }
    
    public function getNamaPoin($tipe)
    {
        if ($tipe == 'positif') {
            // Ambil data dari tabel poin positif
            $poinList = DataPoinPositif::all(['id_poin_positif as id', 'nama_poin as nama_poin']);
        } elseif ($tipe == 'negatif') {
            // Ambil data dari tabel poin negatif
            $poinList = DataPoinNegatif::all(['id_poin_negatif as id', 'nama_poin as nama_poin']);
        } else {
            return response()->json([], 400); // Bad Request jika tipe tidak valid
        }
        
        return response()->json($poinList); // Kembalikan data dalam format JSON
    }
}
