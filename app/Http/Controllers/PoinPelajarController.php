<?php

namespace App\Http\Controllers;

use App\Models\DataPoinNegatif;
use App\Models\DataPoinPositif;
use App\Models\DataSiswa;
use Illuminate\Http\Request;

class PoinPelajarController extends Controller
{
    public function index()
    {
        // Mengambil data siswa beserta poin positif dan negatif
        $dataSiswa = DataSiswa::withCount(['poinPositif', 'poinNegatif'])
        ->having('poin_positif_count', '>', 0)
        ->orHaving('poin_negatif_count', '>', 0)
        ->get();

        // Hitung total poin positif dan negatif untuk setiap siswa
        foreach ($dataSiswa as $siswa) {
            $siswa->total_poin_positif = $siswa->poinPositif->sum('poin');
            $siswa->total_poin_negatif = $siswa->poinNegatif->sum('poin');
        }

        return view('admin.poin_siswa.SiswaPoin', compact('dataSiswa'));
    }

    public function poin_siswa_type()
    {
        return view('admin/poin_siswa/pilihTipe_poin_siswa');
    }

    public function createFormOne()
    {
        return view('admin.poin_siswa.tambahNama_siswa_poin');
    }

    public function searchSiswa(Request $request)
    {
        $search = $request->input('query');
        $dataSiswa = DataSiswa::where('nama', 'LIKE', "%{$search}%")->get();
    
        return response()->json($dataSiswa);
    }
    
    public function storeFormOne(Request $request)
    {
        // Validasi input form, memastikan nama sudah ada di database
        $request->validate([
            'nama' => 'required|exists:data_siswa,nama', // Hanya izinkan nama yang ada di database
            'kelas' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tipe_poin' => 'required|array',
            'keterangan' => 'required|string',
        ]);
    
        // Cari siswa berdasarkan nama
        $siswa = DataSiswa::where('nama', $request->nama)->first();
    
        // Simpan poin sesuai tipe
        if (in_array('positif', $request->tipe_poin)) {
            DataPoinPositif::create([
                'np' => $siswa->nis,
                'poin' => 10,
                'kategori' => $request->keterangan,
            ]);
        }
    
        if (in_array('negatif', $request->tipe_poin)) {
            DataPoinNegatif::create([
                'np' => $siswa->nis,
                'poin' => 5,
                'kategori' => $request->keterangan,
            ]);
        }
    
        return redirect()->route('TambahNamaPoinSiswa')->with('success', 'Poin siswa berhasil ditambahkan.');
    }
    

    public function createFormTwo()
    {
        return view('admin.poin_siswa.tambahNis_siswa_poin');
    }

    public function storeFormTwo(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nis' => 'required|exists:data_siswa,nis',
            'tipe_poin' => 'required|array',
            'keterangan' => 'required|string',
        ]);

        // Cek apakah tipe poin positif dipilih
        if (in_array('positif', $request->tipe_poin)) {
            DataPoinPositif::create([
                'np' => $request->nis,
                'poin' => 10, // Default poin positif
                'kategori' => $request->keterangan,
            ]);
        }

        // Cek apakah tipe poin negatif dipilih
        if (in_array('negatif', $request->tipe_poin)) {
            DataPoinNegatif::create([
                'np' => $request->nis,
                'poin' => 5, // Default poin negatif
                'kategori' => $request->keterangan,
            ]);
        }

        // Redirect ke halaman sukses
        return redirect()->route('TambahNisPoinSiswa')->with('success', 'Poin siswa berhasil ditambahkan.');
    }
}
