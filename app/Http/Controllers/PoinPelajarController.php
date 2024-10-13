<?php

namespace App\Http\Controllers;

use App\Models\DataPoinNegatif;
use App\Models\DataPoinPositif;
use App\Models\DataSiswa;
use App\Models\PoinPelajar;
use App\Models\PoinPeringatan;
use DB;
use Illuminate\Http\Request;

class PoinPelajarController extends Controller
{
    public function index()
    {
        // Mengelompokkan data siswa berdasarkan NIS dan menghitung total poin positif dan negatif
        $dataSiswa = PoinPelajar::select(
            'nis', 
            'nama', 
            'jenis_kelamin', 
            'tingkatan', 
            'jurusan', 
            'jurusan_ke',
            DB::raw('SUM(poin_positif) as total_poin_positif'), // Menghitung total poin positif
            DB::raw('SUM(poin_negatif) as total_poin_negatif')  // Menghitung total poin negatif
        )
        ->groupBy('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke')
        ->get();
    
        // Iterasi untuk menghitung sisa poin
        foreach ($dataSiswa as $siswa) {
            if ($siswa->total_poin_positif > $siswa->total_poin_negatif) {
                // Jika poin positif lebih besar, sisa poin positif
                $siswa->poin_positif_akhir = $siswa->total_poin_positif - $siswa->total_poin_negatif;
                $siswa->poin_negatif_akhir = 0; // Tidak ada poin negatif tersisa
            } else {
                // Jika poin negatif lebih besar atau sama, sisa poin negatif
                $siswa->poin_negatif_akhir = $siswa->total_poin_negatif - $siswa->total_poin_positif;
                $siswa->poin_positif_akhir = 0; // Tidak ada poin positif tersisa
            }
        }
    
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
    

    public function createFormOne()
    {
        $tingkatanList = DB::table('data_siswa')->distinct()->pluck('tingkatan');

        return view('admin.poin_siswa.tambahNama_siswa_poin', compact('tingkatanList'));
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
    

    
    public function storeFormOne(Request $request)
    {
        // Validasi input form
        $request->validate([
            'tingkatan' => 'required|integer',
            'jurusan' => 'required|string',
            'jurusan_ke' => 'required|integer',
            'nama' => 'required|exists:data_siswa,nama',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tipe_poin' => 'required|in:positif,negatif',
            'nama_poin' => 'required|string',
        ]);
    
        // Ambil data siswa dari tabel data_siswa berdasarkan input
        $siswa = DataSiswa::where('nama', $request->nama)
                          ->where('tingkatan', $request->tingkatan)
                          ->where('jurusan', $request->jurusan)
                          ->where('jurusan_ke', $request->jurusan_ke)
                          ->first();
        
        // Cek apakah data siswa ditemukan
        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
        }
    
        // Ambil data poin dari tabel poin yang sesuai dengan tipe poin
        $poin = null;
        if ($request->tipe_poin === 'negatif') {
            $poin = DataPoinNegatif::where('nama_poin', $request->nama_poin)->first();
        } else if ($request->tipe_poin === 'positif') {
            $poin = DataPoinPositif::where('nama_poin', $request->nama_poin)->first();
        }
    
        // Cek apakah poin ditemukan
        if (!$poin) {
            return redirect()->back()->with('error', 'Poin yang dipilih tidak ditemukan.');
        }
    
        // Buat entri baru di tabel poin_pelajar
        $poinPelajar = new PoinPelajar();
        $poinPelajar->nis = $siswa->nis; // Ambil NIS dari data siswa
        $poinPelajar->nama = $siswa->nama;
        $poinPelajar->tingkatan = $siswa->tingkatan;
        $poinPelajar->jurusan = $siswa->jurusan;
        $poinPelajar->jurusan_ke = $siswa->jurusan_ke;
        $poinPelajar->jenis_kelamin = $siswa->jenis_kelamin;
        $poinPelajar->tahun_angkatan = $siswa->tahun_angkatan; // Ambil tahun angkatan
    
        // Tambahkan poin sesuai tipe poin
        if ($request->tipe_poin === 'positif') {
            $poinPelajar->poin_positif = $poin->poin; // Set poin positif
            $poinPelajar->poin_negatif = 0; // Poin negatif diisi 0
            $poinPelajar->nama_poin_positif = $poin->nama_poin; // Set nama poin positif
            $poinPelajar->nama_poin_negatif = null; // Kosongkan nama poin negatif
        } elseif ($request->tipe_poin === 'negatif') {
            $poinPelajar->poin_negatif = $poin->poin; // Set poin negatif
            $poinPelajar->poin_positif = 0; // Poin positif diisi 0
            $poinPelajar->nama_poin_negatif = $poin->nama_poin; // Set nama poin negatif
            $poinPelajar->nama_poin_positif = null; // Kosongkan nama poin positif
        }
    
        // Simpan data ke tabel poin_pelajar
        $poinPelajar->save();
    
        // Redirect ke halaman dengan pesan sukses
        return redirect()->route('PoinSiswa')->with('success', 'Poin berhasil ditambahkan.');
    }
    
    
    
    
    
    public function hapusSemua(Request $request)
    {
        // Menghapus semua data poin siswa
        PoinPelajar::truncate(); // Menghapus semua data dari tabel poin_pelajar
    
        return redirect()->back()->with('success', 'Semua data poin siswa berhasil dihapus.');
    }
    

}
