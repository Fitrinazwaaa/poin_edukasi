<?php

namespace App\Http\Controllers;

use App\Models\DataPoinNegatif;
use App\Models\DataPoinPositif;
use App\Models\DataSiswa;
use App\Models\PoinPelajar;
use App\Models\PoinPeringatan;
use DB;
use Illuminate\Http\Request;
use Log;

class PoinPelajarController extends Controller
{
    public function index()
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
    
    public function createFormOne()
    {
        $tingkatanList = DB::table('data_siswa')->distinct()->pluck('tingkatan');

        return view('admin.poin_siswa.tambahNama_siswa_poin', compact('tingkatanList'));
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
    
        $userRole = auth()->user()->role; // Mengambil role pengguna saat ini
        $isGuruRole = $userRole == 'user_edit'; // 'Guru' role untuk user yang hanya bisa input poin negatif satu kali
    
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
        $poin = $request->tipe_poin === 'negatif'
            ? DataPoinNegatif::where('nama_poin', $request->nama_poin)->first()
            : DataPoinPositif::where('nama_poin', $request->nama_poin)->first();
    
        // Cek apakah poin ditemukan
        if (!$poin) {
            return redirect()->back()->with('error', 'Poin yang dipilih tidak ditemukan.');
        }
    
        // Cek input poin negatif yang sama di hari yang sama untuk role Guru
        if ($isGuruRole && $request->tipe_poin === 'negatif') {
            $today = now()->startOfDay();
            $alreadyExists = PoinPelajar::where('nis', $siswa->nis)
                ->where('nama_poin_negatif', $request->nama_poin)
                ->where('created_at', '>=', $today) // Filter poin negatif yang dibuat hari ini
                ->exists();
    
            if ($alreadyExists) {
                return redirect()->back()->with('error', 'Anda hanya dapat menginput poin negatif ini satu kali dalam sehari.');
            }
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
    
        return redirect()->route('PoinSiswa')->with('success', 'Poin berhasil ditambahkan.');
    }
    
    public function createPerbaikan(string $id)
    {
        $tingkatanList = DB::table('data_siswa')->distinct()->pluck('tingkatan');
        $data=DataSiswa::where('nis', $id)->firstorfail();

        return view('admin.poin_siswa.notifikasi.form_perbaikan_sikap', compact('tingkatanList', 'data'));
    }

    public function storePerbaikan(Request $request)
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
    
    public function viewSiswaDetail($nis)
    {
        // Ambil data siswa berdasarkan NIS
        $siswa = PoinPelajar::where('nis', $nis)->first();
    
        // Cek apakah data siswa ada
        if (!$siswa) {
            // Jika siswa tidak ditemukan, redirect kembali dengan pesan
            return redirect()->route('PoinSiswa')->with('error', 'Data siswa tidak ditemukan');
        }
    
        // Ambil semua data poin positif dan negatif dari siswa tersebut
        $poinPositif = PoinPelajar::where('nis', $nis)->whereNotNull('nama_poin_positif')->get();
        $poinNegatif = PoinPelajar::where('nis', $nis)->whereNotNull('nama_poin_negatif')->get();
    
        // Kirim data siswa dan poin ke view
        return view('admin.poin_siswa.view_data_siswa', [
            'siswa' => $siswa,
            'poinPositif' => $poinPositif,
            'poinNegatif' => $poinNegatif
        ]);
    }
    
    
    public function deletePoinPositif(Request $request)
{
    PoinPelajar::whereIn('id', $request->ids)->whereNotNull('nama_poin_positif')->delete();
    return response()->json(['success' => "Poin positif berhasil dihapus."]);
}

public function deletePoinNegatif(Request $request)
{
    PoinPelajar::whereIn('id', $request->ids)->whereNotNull('nama_poin_negatif')->delete();
    return response()->json(['success' => "Poin negatif berhasil dihapus."]);
}

    public function hapusSemua(Request $request)
    {
        // Menghapus semua data poin siswa
        PoinPelajar::truncate(); // Menghapus semua data dari tabel poin_pelajar
    
        return redirect()->back()->with('success', 'Semua data poin siswa berhasil dihapus.');
    }

    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nis'           => 'required|string',
            'nama'          => 'required|string|max:255',
            'tingkatan'     => 'required|integer',
            'jurusan'       => 'required|string|max:255',
            'jurusan_ke'    => 'required|integer',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'tahun_angkatan'=> 'required|integer',
        ]);
    
        // Update data di tabel data_siswa
        $dataSiswa = DataSiswa::where('nis', $id)->firstOrFail();
        $dataSiswa->update([
            'nis'               => $request->input('nis'),
            'nama'              => $request->input('nama'),
            'tingkatan'         => $request->input('tingkatan'),
            'jurusan'           => $request->input('jurusan'),
            'jurusan_ke'        => $request->input('jurusan_ke'),
            'jenis_kelamin'     => $request->input('jenis_kelamin'),
            'tahun_angkatan'    => $request->input('tahun_angkatan'),
        ]);
    
        // Logging untuk memeriksa nilai input
        Log::info('Data siswa yang diupdate:', [
            'nis' => $request->input('nis'),
            'tingkatan' => $request->input('tingkatan'),
            'jurusan_ke' => $request->input('jurusan_ke'),
            'tahun_angkatan' => $request->input('tahun_angkatan'),
        ]);
    
        // Cari data poin pelajar berdasarkan NIS
        $dataPoinPelajar = PoinPelajar::where('nis', $id)->first();
    
        // Pastikan data poin pelajar ditemukan sebelum update
        if ($dataPoinPelajar) {
            $dataPoinPelajar->update([
                'nis'               => $request->input('nis'),
                'nama'              => $request->input('nama'),
                'tingkatan'         => (int) $request->input('tingkatan'), // casting integer
                'jurusan'           => $request->input('jurusan'),
                'jurusan_ke'        => (int) $request->input('jurusan_ke'), // casting integer
                'jenis_kelamin'     => $request->input('jenis_kelamin'),
                'tahun_angkatan'    => (int) $request->input('tahun_angkatan'), // casting integer
            ]);
        } else {
            Log::error('Data poin pelajar tidak ditemukan untuk NIS: ' . $id);
        }
    
        return redirect()->route('Siswa')->with('success', 'Data siswa dan poin pelajar berhasil diperbarui.');
    }

        public function notifikasi1()
    {
        // Ambil data poin peringatan dari tabel PoinPeringatan berdasarkan ID
        $poinPeringatan1 = PoinPeringatan::where('id_peringatan', '1')->first(); // Ambil satu data dengan first()
        $poinPeringatan2 = PoinPeringatan::where('id_peringatan', '2')->first();
    
        if ($poinPeringatan1 && $poinPeringatan2) {
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif > poinPeringatan1 dan <= poinPeringatan2
            $dataSiswa = PoinPelajar::where('jumlah_negatif', '>', $poinPeringatan1->max_poin)
                                    ->where('jumlah_negatif', '<=', $poinPeringatan2->max_poin)
                                    ->groupBy('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')  // Group by semua kolom yang dipilih
                                    ->select('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')
                                    ->get();
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
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif > poinPeringatan2 dan <= poinPeringatan3
            $dataSiswa = PoinPelajar::where('jumlah_negatif', '>', $poinPeringatan2->max_poin)
                                    ->where('jumlah_negatif', '<=', $poinPeringatan3->max_poin)
                                    ->groupBy('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')  // Group by semua kolom yang dipilih
                                    ->select('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')
                                    ->get();
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
        // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif > poinPeringatan3 dan <= poinPeringatan4
        $dataSiswa = PoinPelajar::where('jumlah_negatif', '>', $poinPeringatan3->max_poin)
                                ->where('jumlah_negatif', '<=', $poinPeringatan4->max_poin)
                                ->groupBy('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')  // Group by semua kolom yang dipilih
                                    ->select('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')
                                ->get();
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
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif > poinPeringatan4 dan <= poinPeringatan5
            $dataSiswa = PoinPelajar::where('jumlah_negatif', '>', $poinPeringatan4->max_poin)
                                    ->where('jumlah_negatif', '<=', $poinPeringatan5->max_poin)
                                    ->groupBy('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')  // Group by semua kolom yang dipilih
                                    ->select('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')
                                    ->get();

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
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif > poinPeringatan5 dan <= poinPeringatan6
            $dataSiswa = PoinPelajar::where('jumlah_negatif', '>', $poinPeringatan5->max_poin)
                                    ->where('jumlah_negatif', '<=', $poinPeringatan6->max_poin)
                                    ->groupBy('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')  // Group by semua kolom yang dipilih
                                    ->select('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')
                                    ->get();
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
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif > poinPeringatan6 dan <= poinPeringatan7
            $dataSiswa = PoinPelajar::where('jumlah_negatif', '>', $poinPeringatan6->max_poin)
                                    ->where('jumlah_negatif', '<=', $poinPeringatan7->max_poin)
                                    ->groupBy('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')  // Group by semua kolom yang dipilih
                                    ->select('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')
                                    ->get();
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
            // Ambil data siswa dari tabel poin_pelajar yang memiliki poin negatif > poinPeringatan7 dan <= poinPeringatan8
            $dataSiswa = PoinPelajar::where('jumlah_negatif', '>', $poinPeringatan7->max_poin)
                                    ->where('jumlah_negatif', '<=', $poinPeringatan8->max_poin)
                                    ->groupBy('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')  // Group by semua kolom yang dipilih
                                    ->select('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')
                                    ->get();
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
            $dataSiswa = PoinPelajar::where('poin_negatif', '>=', $poinPeringatan8->max_poin)
                                    ->groupBy('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')  // Group by semua kolom yang dipilih
                                    ->select('nis', 'nama', 'jenis_kelamin', 'tingkatan', 'jurusan', 'jurusan_ke', 'jumlah_negatif')
                                    ->get();
        } else {
            // Jika poin peringatan tidak ditemukan, kembalikan error atau set data kosong
            $dataSiswa = collect(); // Collection kosong
        }

        // Pass dataSiswa dan poinPeringatan8 ke view
        return view('admin.poin_siswa.notifikasi.notifikasi8', compact('dataSiswa', 'poinPeringatan8'));
    }
}
