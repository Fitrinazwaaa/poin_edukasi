<?php

namespace App\Http\Controllers;

use App\Models\DataKelas;
use Illuminate\Http\Request;

class DataKelasController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data siswa
        $kelas = DataKelas::all();
    
        // Mengelompokkan kelas berdasarkan tahun angkatan
        $kelasByTahun = $kelas->groupBy(function($item) {
            // Asumsikan tahun angkatan disimpan dalam kolom 'tahun_angkatan'
            return $item->tahun_angkatan;
        });
    
        // Mengirim data ke view
        return view('admin.kelas.halaman_kelas', compact('kelasByTahun'));
    }

    public function create()
    {
        return view('admin.kelas.tambah_kelas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'tahun_angkatan' => 'required|numeric',
            'jurusan' => 'required|string',
            'jurusan_ke' => 'required|numeric|min:1',  // Pastikan 'jurusan_ke' adalah angka dan minimal 1
        ]);
    
        // Tangkap input dari form
        $tahun_angkatan = $request->input('tahun_angkatan');
        $jurusan = $request->input('jurusan');
        $jumlahKelas = $request->input('jurusan_ke'); // Jumlah kelas
    
        // Loop sesuai dengan jumlah kelas yang dimasukkan
        for ($i = 1; $i <= $jumlahKelas; $i++) {
            // Simpan ke database untuk setiap kelas
            DataKelas::create([
                'tahun_angkatan' => $tahun_angkatan,
                'jurusan' => $jurusan,
                'jurusan_ke' => $i,  // Ini akan menyimpan 1, 2, 3, dst.
            ]);
        }
    
        return redirect()->route('kelas')->with('success', 'Data kelas berhasil ditambahkan.');
    }    

    public function destroyMultiple(Request $request)
    {
        // Validasi input
        $request->validate([
            'hapus' => 'required|array|min:1',
            'hapus.*' => 'exists:data_kelas,id', // pastikan id yang dipilih valid
        ]);
    
        // Hapus entri yang dipilih
        DataKelas::whereIn('id', $request->hapus)->delete();
    
        return redirect()->route('kelas')->with('success', 'Kelas yang dipilih berhasil dihapus.');
    }
    
}
