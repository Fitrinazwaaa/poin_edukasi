<?php

namespace App\Http\Controllers;

use App\Models\DataPoinNegatif;
use App\Models\DataPoinPositif;
use App\Models\DataSiswa;
use App\Models\PoinPelajar;
use App\Models\PoinPeringatan;
use Illuminate\Http\Request;

class PoinPelajarController extends Controller
{
    public function index()
    {
        // Mengambil data siswa dari tabel poin_pelajar yang sudah menyimpan total poin positif dan negatif
        $dataSiswa = PoinPelajar::all();
    
        return view('admin.poin_siswa.SiswaPoin', compact('dataSiswa'));
    }    

    public function poin_siswa_type()
    {
        return view('admin.poin_siswa.pilihTipe_poin_siswa');
    }

    public function searchSiswa(Request $request)
    {
        $search = $request->input('query');
        $dataSiswa = DataSiswa::where('nama', 'LIKE', "%{$search}%")->get();
        
        return response()->json($dataSiswa);
    }

    public function createFormOne()
    {
        return view('admin.poin_siswa.tambahNama_siswa_poin');
    }
    
    public function storeFormOne(Request $request)
    {
        // Validasi input form, memastikan nama sudah ada di database
        $request->validate([
            'nama' => 'required|exists:data_siswa,nama',
            'kelas' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tipe_poin' => 'required|array',
            'np' => 'required|string',
        ]);
    
        // Cari siswa berdasarkan nama
        $siswa = DataSiswa::where('nama', $request->nama)->first();
    
        // Ambil poin dari np yang diinput
        $poinNegatif = DataPoinNegatif::where('np', $request->np)->first();
        $poinPositif = DataPoinPositif::where('np', $request->np)->first();
    
        // Ambil data poin siswa dari tabel poin_pelajar
        $poinPelajar = PoinPelajar::where('nis', $siswa->nis)->first();
    
        // Jika data siswa belum ada di tabel poin_pelajar, buat data baru
        if (!$poinPelajar) {
            $poinPelajar = new PoinPelajar();
            $poinPelajar->nis = $siswa->nis;
            $poinPelajar->nama = $siswa->nama;
            $poinPelajar->kelas = $siswa->kelas;
            $poinPelajar->jenis_kelamin = $siswa->jenis_kelamin;
            $poinPelajar->poin_negatif = 0;
            $poinPelajar->poin_positif = 0;
        }
    
        // Tambahkan poin sesuai tipe
        if (in_array('positif', $request->tipe_poin) && $poinPositif) {
            $poinPelajar->poin_positif += $poinPositif->poin ?? 0;
        }
    
        if (in_array('negatif', $request->tipe_poin) && $poinNegatif) {
            $poinPelajar->poin_negatif += $poinNegatif->poin ?? 0;
        }
    
        // Kurangi poin negatif dengan poin positif
        $pengurang = min($poinPelajar->poin_positif, $poinPelajar->poin_negatif); // Jumlah pengurangan
        $poinPelajar->poin_negatif -= $pengurang; // Kurangi poin negatif
        $poinPelajar->poin_positif -= $pengurang; // Kurangi poin positif
    
        // Simpan perubahan
        $poinPelajar->save();
    
        return redirect()->route('TambahNamaPoinSiswa')->with('success', 'Poin siswa berhasil ditambahkan.');
    }    
    
    public function createFormTwo()
    {
        return view('admin.poin_siswa.tambahNis_siswa_poin');
    }

    public function storeFormTwo(Request $request)
    {
        // Validasi input form, memastikan NIS sudah ada di database
        $request->validate([
            'nis' => 'required|exists:data_siswa,nis',
            'tipe_poin' => 'required|array',
            'np' => 'required|string', 
        ]);
    
        // Cari siswa berdasarkan NIS
        $siswa = DataSiswa::where('nis', $request->nis)->first();
    
        // Ambil poin dari np yang diinput
        $poinNegatif = DataPoinNegatif::where('np', $request->np)->first();
        $poinPositif = DataPoinPositif::where('np', $request->np)->first();
    
        // Ambil atau buat data poin siswa dari tabel poin_pelajar
        $poinPelajar = PoinPelajar::updateOrCreate(
            ['nis' => $siswa->nis],
            [
                'nama' => $siswa->nama,
                'kelas' => $siswa->kelas, 
                'jenis_kelamin' => $siswa->jenis_kelamin, 
            ]
        );
    
        // Tambahkan poin sesuai tipe
        if (in_array('positif', $request->tipe_poin) && $poinPositif) {
            $poinPelajar->poin_positif += $poinPositif->poin ?? 0;
        }
    
        if (in_array('negatif', $request->tipe_poin) && $poinNegatif) {
            $poinPelajar->poin_negatif += $poinNegatif->poin ?? 0;
        }
    
        // Kurangi poin negatif dengan poin positif
        $pengurang = min($poinPelajar->poin_positif, $poinPelajar->poin_negatif); 
        $poinPelajar->poin_negatif -= $pengurang; 
        $poinPelajar->poin_positif -= $pengurang; 
    
        // Simpan perubahan
        $poinPelajar->save();
    
        return redirect()->route('TambahNisPoinSiswa')->with('success', 'Poin siswa berhasil ditambahkan.');
    }    
    
    public function showSuratPerjanjian()
    {
        // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif >= 75
        $dataSiswa = PoinPelajar::where('poin_negatif', '>=', 75)->get();
        $poinPeringatan1 = PoinPeringatan::where('id_peringatan', '1')->get();
        $poinPeringatan2 = PoinPeringatan::where('id_peringatan', '2')->get();
        $poinPeringatan3 = PoinPeringatan::where('id_peringatan', '3')->get();
        $poinPeringatan4 = PoinPeringatan::where('id_peringatan', '4')->get();
        $poinPeringatan5 = PoinPeringatan::where('id_peringatan', '5')->get();
        $poinPeringatan6 = PoinPeringatan::where('id_peringatan', '6')->get();
        $poinPeringatan7 = PoinPeringatan::where('id_peringatan', '7')->get();
        $poinPeringatan8 = PoinPeringatan::where('id_peringatan', '8')->get();
    
        // Pass dataSiswa to the view
        return view('admin.peringatan.bermaterai', compact('dataSiswa', 'poinPeringatan1', 'poinPeringatan2', 'poinPeringatan3', 'poinPeringatan4', 'poinPeringatan5', 'poinPeringatan6', 'poinPeringatan7', 'poinPeringatan8'));
    }
}
