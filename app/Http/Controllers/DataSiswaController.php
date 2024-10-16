<?php

namespace App\Http\Controllers;

use App\Models\DataKelas;
use App\Models\DataSiswa; // Menggunakan model DataSiswa
use DB;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        return view('admin.siswa.siswa', compact('siswaByTahun', 'tahun_angkatan', 'data_kelas'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Tambahkan validasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|integer|unique:data_siswa,nis',
            'jenis_kelamin' => 'required',
            'tahun_angkatan' => 'required',
            'tingkatan' => 'required',
            'jurusan' => 'required',
            'jurusan_ke' => 'required',
        ]);
    
        try {
            DataSiswa::create($request->all());
            return redirect()->with('success', 'Data siswa berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data, harap masukkan kembali');
        }
    }
    
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=DataSiswa::where('nis', $id)->firstorfail();
        return view('admin.siswa.edit_siswa', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update data siswa
        $dataSiswa = DataSiswa::where('nis', $id)->firstOrFail();
        $dataSiswa->update($request->only(['nis', 'nama', 'tingkatan', 'jurusan', 'jurusan_ke', 'jenis_kelamin', 'tahun_angkatan']));

        // Update data poin pelajar terkait jika ada
        if ($dataSiswa->poinPelajar) {
            $dataSiswa->poinPelajar->update($request->only(['nis', 'nama', 'tingkatan', 'jurusan', 'jurusan_ke', 'jenis_kelamin', 'tahun_angkatan']));
        }

        return redirect()->route('Siswa')->with('success', 'Data siswa dan poin pelajar berhasil diperbarui.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroyMultiple(Request $request)
    {
        // Validasi input
        $request->validate([
            'hapus' => 'required|array|min:1',
            'hapus.*' => 'exists:data_siswa,nis', // pastikan nis yang dipilih valid
        ]);
    
        // Hapus entri yang dipilih berdasarkan nis
        DataSiswa::whereIn('nis', $request->hapus)->delete();
    
        return redirect()->route('Siswa')->with('success', 'Siswa yang dipilih berhasil dihapus.');
    }
    

    public function getJurusanDataSiswa($tahun_angkatan)
    {
        $jurusan = DB::table('data_kelas')
                     ->where('tahun_angkatan', $tahun_angkatan)
                     ->get(['tahun_angkatan', 'jurusan', 'jurusan_ke']); // mengambil jurusan dan jurusan_ke
    
        return response()->json($jurusan);
    }
    
    public function getJurusanKeDataSiswa($jurusan)
    {
        $data = DB::table('data_kelas')->where('jurusan', $jurusan)->get(['jurusan_ke']);
        return response()->json($data);
    }
}
