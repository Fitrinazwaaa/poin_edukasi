<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\DataKelas;
use App\Models\DataSiswa; // Menggunakan model DataSiswa
use App\Models\PoinPelajar;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Eksports\SiswaEksport;
use App\Models\DataUser;
use Session;

class DataSiswaController extends Controller
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
    

    public function show(string $id)
    {
        //
    }


    public function edit($nis)
    {
        // Ambil data siswa berdasarkan NIS
        $data = DataSiswa::where('nis', $nis)->first();
    
        // Ambil daftar tahun angkatan dari database dengan pluck
        $tahun_angkatan = DB::table('data_kelas')->distinct()->pluck('tahun_angkatan');
        $jurusan = DB::table('data_kelas')->distinct()->pluck('jurusan');
        $jurusan_ke = DB::table('data_kelas')->distinct()->pluck('jurusan_ke');
    
        return view('admin.siswa.edit_siswa', [
            'data' => $data,
            'tahun_angkatan' => $tahun_angkatan,
            'jurusan' => $jurusan,
            'jurusan_ke' => $jurusan_ke,
        ]);
    }
    

    public function update(Request $request, string $id)
    {
        // Validasi input data
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|integer|unique:data_siswa,nis,' . $id . ',nis', // Memastikan NIS unik kecuali untuk siswa yang sedang diedit
            'jenis_kelamin' => 'required',
            'tahun_angkatan' => 'required',
            'tingkatan' => 'required',
            'jurusan' => 'required',
            'jurusan_ke' => 'required',
        ]);
    
        // Ambil data siswa berdasarkan NIS yang diberikan
        $dataSiswa = DataSiswa::where('nis', $id)->firstOrFail();
    
        // Update data siswa dengan data yang diterima dari form
        $dataSiswa->update($request->only([
            'nis', 
            'nama', 
            'tingkatan', 
            'jurusan', 
            'jurusan_ke', 
            'jenis_kelamin', 
            'tahun_angkatan'
        ]));
    
        // Update semua data di poin_pelajar yang memiliki nis yang sama
        $dataSiswa->poinPelajar()->update($request->only([
            'nis', 
            'nama', 
            'tingkatan', 
            'jurusan', 
            'jurusan_ke', 
            'jenis_kelamin', 
            'tahun_angkatan'
        ]));
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('Siswa')->with('success', 'Data siswa dan semua poin pelajar berhasil diperbarui.');
    }
    

    public function destroyMultiple(Request $request)
    {
        // Validasi input
        $request->validate([
            'hapus' => 'required|array|min:1',
            'hapus.*' => 'exists:data_siswa,nis', // pastikan nis yang dipilih valid
        ]);

        // Hapus data poin pelajar dengan NIS yang sesuai
        PoinPelajar::whereIn('nis', $request->hapus)->delete();

        // Hapus entri siswa berdasarkan NIS yang dipilih
        DataSiswa::whereIn('nis', $request->hapus)->delete();

        return redirect()->route('Siswa')->with('success', 'Siswa yang dipilih beserta data poin berhasil dihapus.');
    }

    
    public function getjurusanDataSiswa($tahun_angkatan)
    {
        $jurusan = DB::table('data_kelas')
                     ->where('tahun_angkatan', $tahun_angkatan)
                     ->get(['tahun_angkatan', 'jurusan', 'jurusan_ke']); // mengambil jurusan dan jurusan_ke
        
        return response()->json($jurusan);
    }
    
    
    public function getjurusanKeDataSiswa($tahun_angkatan, $jurusan)
    {
        // Ambil data jurusan_ke yang unik berdasarkan tahun angkatan dan jurusan
        $data = DB::table('data_kelas')
                  ->where('tahun_angkatan', $tahun_angkatan)
                  ->where('jurusan', $jurusan)
                  ->distinct()  // Untuk menghindari duplikasi
                  ->get(['jurusan_ke']);
                  
        return response()->json($data);
    }    


    public function EksportSiswa()
    {
        return Excel::download(new SiswaEksport, 'data_siswa.xlsx');
    }


    public function import(Request $request)
    {
        try {
            Excel::import(new SiswaImport, $request->file('file'));
            return redirect()->back()
                             ->with('success', 'Data siswa berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan saat impor :  ' . $e->getMessage());
        }
    }    


    public function replace(Request $request, $nis)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tingkatan' => 'required|integer',
            'jurusan' => 'required|string|max:255',
            'jurusan_ke' => 'required|integer',
            'jenis_kelamin' => 'required|string|max:10',
            'tahun_angkatan' => 'required|integer',
        ]);
    
        // Cari data berdasarkan NIS
        $data = DataSiswa::where('nis', $nis)->first();
    
        if ($data) {
            // Lakukan update
            $data->update($validatedData);
            return redirect()->route('siswa.index')->with('success', 'Data berhasil diperbarui!');
        }
    
        return redirect()->route('siswa.index')->with('error', 'Data tidak ditemukan!');
    }    


    public function increaseTingkatan()
    {
        // Perbarui semua data siswa dengan menambah nilai tingkatan sebesar 1
        DB::table('data_siswa')->increment('tingkatan', 1);

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('Siswa')->with('success', 'Tingkatan semua siswa berhasil ditambah 1.');
    }

}
