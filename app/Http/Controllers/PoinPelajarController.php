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
    
        return redirect()->route('PoinSiswa')->with('success', 'Poin siswa berhasil ditambahkan.');
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
    
        return redirect()->route('PoinSiswa')->with('success', 'Poin siswa berhasil ditambahkan.');
    }    
    
    public function notifikasi1()
    {
        // Ambil data poin peringatan dari tabel PoinPeringatan berdasarkan ID
        $poinPeringatan1 = PoinPeringatan::where('id_peringatan', '1')->first(); // Ambil satu data dengan first()
        $poinPeringatan2 = PoinPeringatan::where('id_peringatan', '2')->first();
    
        // Pastikan data poin peringatan ada sebelum melanjutkan
        if ($poinPeringatan1 && $poinPeringatan2) {
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif dalam rentang max_poin
            $dataSiswa = PoinPelajar::whereBetween('poin_negatif', [$poinPeringatan1->max_poin, $poinPeringatan2->max_poin])->get();
        } else {
            // Jika poin peringatan tidak ditemukan, kembalikan error atau set data kosong
            $dataSiswa = collect(); // Collection kosong
        }
    
        // Pass dataSiswa, poinPeringatan1, dan poinPeringatan2 ke view
        return view('admin.poin_siswa.notifikasi.notifikasi1', compact('dataSiswa', 'poinPeringatan1', 'poinPeringatan2'));
    }
    
    public function notifikasi2()
    {
        // Ambil data poin peringatan dari tabel PoinPeringatan berdasarkan ID
        $poinPeringatan2 = PoinPeringatan::where('id_peringatan', '2')->first(); // Ambil satu data dengan first()
        $poinPeringatan3 = PoinPeringatan::where('id_peringatan', '3')->first();
    
        // Pastikan data poin peringatan ada sebelum melanjutkan
        if ($poinPeringatan2 && $poinPeringatan3) {
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif dalam rentang max_poin
            $dataSiswa = PoinPelajar::whereBetween('poin_negatif', [$poinPeringatan2->max_poin, $poinPeringatan3->max_poin])->get();
        } else {
            // Jika poin peringatan tidak ditemukan, kembalikan error atau set data kosong
            $dataSiswa = collect(); // Collection kosong
        }
    
        // Pass dataSiswa, poinPeringatan2, dan poinPeringatan3 ke view
        return view('admin.poin_siswa.notifikasi.notifikasi2', compact('dataSiswa', 'poinPeringatan2', 'poinPeringatan3'));
    }
    
    public function notifikasi3()
    {
        // Ambil data poin peringatan dari tabel PoinPeringatan berdasarkan ID
        $poinPeringatan3 = PoinPeringatan::where('id_peringatan', '3')->first(); // Ambil satu data dengan first()
        $poinPeringatan4 = PoinPeringatan::where('id_peringatan', '4')->first();
    
        // Pastikan data poin peringatan ada sebelum melanjutkan
        if ($poinPeringatan3 && $poinPeringatan4) {
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif dalam rentang max_poin
            $dataSiswa = PoinPelajar::whereBetween('poin_negatif', [$poinPeringatan3->max_poin, $poinPeringatan4->max_poin])->get();
        } else {
            // Jika poin peringatan tidak ditemukan, kembalikan error atau set data kosong
            $dataSiswa = collect(); // Collection kosong
        }
    
        // Pass dataSiswa, poinPeringatan3, dan poinPeringatan4 ke view
        return view('admin.poin_siswa.notifikasi.notifikasi3', compact('dataSiswa', 'poinPeringatan3', 'poinPeringatan4'));
    }
    
    public function notifikasi4()
    {
        // Ambil data poin peringatan dari tabel PoinPeringatan berdasarkan ID
        $poinPeringatan4 = PoinPeringatan::where('id_peringatan', '4')->first(); // Ambil satu data dengan first()
        $poinPeringatan5 = PoinPeringatan::where('id_peringatan', '5')->first();
    
        // Pastikan data poin peringatan ada sebelum melanjutkan
        if ($poinPeringatan4 && $poinPeringatan5) {
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif dalam rentang max_poin
            $dataSiswa = PoinPelajar::whereBetween('poin_negatif', [$poinPeringatan4->max_poin, $poinPeringatan5->max_poin])->get();
        } else {
            // Jika poin peringatan tidak ditemukan, kembalikan error atau set data kosong
            $dataSiswa = collect(); // Collection kosong
        }
    
        // Pass dataSiswa, poinPeringatan4, dan poinPeringatan5 ke view
        return view('admin.poin_siswa.notifikasi.notifikasi4', compact('dataSiswa', 'poinPeringatan4', 'poinPeringatan5'));
    }
    
    public function notifikasi5()
    {
        // Ambil data poin peringatan dari tabel PoinPeringatan berdasarkan ID
        $poinPeringatan5 = PoinPeringatan::where('id_peringatan', '5')->first(); // Ambil satu data dengan first()
        $poinPeringatan6 = PoinPeringatan::where('id_peringatan', '6')->first();
    
        // Pastikan data poin peringatan ada sebelum melanjutkan
        if ($poinPeringatan5 && $poinPeringatan6) {
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif dalam rentang max_poin
            $dataSiswa = PoinPelajar::whereBetween('poin_negatif', [$poinPeringatan5->max_poin, $poinPeringatan6->max_poin])->get();
        } else {
            // Jika poin peringatan tidak ditemukan, kembalikan error atau set data kosong
            $dataSiswa = collect(); // Collection kosong
        }
    
        // Pass dataSiswa, poinPeringatan5, dan poinPeringatan6 ke view
        return view('admin.poin_siswa.notifikasi.notifikasi5', compact('dataSiswa', 'poinPeringatan5', 'poinPeringatan6'));
    }
    
    public function notifikasi6()
    {
        // Ambil data poin peringatan dari tabel PoinPeringatan berdasarkan ID
        $poinPeringatan6 = PoinPeringatan::where('id_peringatan', '6')->first(); // Ambil satu data dengan first()
        $poinPeringatan7 = PoinPeringatan::where('id_peringatan', '7')->first();
    
        // Pastikan data poin peringatan ada sebelum melanjutkan
        if ($poinPeringatan6 && $poinPeringatan7) {
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif dalam rentang max_poin
            $dataSiswa = PoinPelajar::whereBetween('poin_negatif', [$poinPeringatan6->max_poin, $poinPeringatan7->max_poin])->get();
        } else {
            // Jika poin peringatan tidak ditemukan, kembalikan error atau set data kosong
            $dataSiswa = collect(); // Collection kosong
        }
    
        // Pass dataSiswa, poinPeringatan6, dan poinPeringatan7 ke view
        return view('admin.poin_siswa.notifikasi.notifikasi6', compact('dataSiswa', 'poinPeringatan6', 'poinPeringatan7'));
    }
    
    public function notifikasi7()
    {
        // Ambil data poin peringatan dari tabel PoinPeringatan berdasarkan ID
        $poinPeringatan7 = PoinPeringatan::where('id_peringatan', '7')->first(); // Ambil satu data dengan first()
        $poinPeringatan8 = PoinPeringatan::where('id_peringatan', '8')->first();
    
        // Pastikan data poin peringatan ada sebelum melanjutkan
        if ($poinPeringatan7 && $poinPeringatan8) {
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif dalam rentang max_poin
            $dataSiswa = PoinPelajar::whereBetween('poin_negatif', [$poinPeringatan7->max_poin, $poinPeringatan8->max_poin])->get();
        } else {
            // Jika poin peringatan tidak ditemukan, kembalikan error atau set data kosong
            $dataSiswa = collect(); // Collection kosong
        }
    
        // Pass dataSiswa, poinPeringatan7, dan poinPeringatan8 ke view
        return view('admin.poin_siswa.notifikasi.notifikasi7', compact('dataSiswa', 'poinPeringatan7', 'poinPeringatan8'));
    }
    
    public function notifikasi8()
    {
        // Ambil data poin peringatan dari tabel PoinPeringatan berdasarkan ID
        $poinPeringatan8 = PoinPeringatan::where('id_peringatan', '8')->first();
        
        // Pastikan data poin peringatan ada sebelum melanjutkan
        if ($poinPeringatan8) {
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif >= max_poin
            $dataSiswa = PoinPelajar::where('poin_negatif', '>=', $poinPeringatan8->max_poin)->get();
        } else {
            // Jika poin peringatan tidak ditemukan, kembalikan error atau set data kosong
            $dataSiswa = collect(); // Collection kosong
        }

        // Pass dataSiswa dan poinPeringatan8 ke view
        return view('admin.poin_siswa.notifikasi.notifikasi8', compact('dataSiswa', 'poinPeringatan8'));
    }

    public function formulir_perbaikan()
    {
        return view('admin/poin_siswa.notifikasi.form_perbaikan_sikap');
    }

}
