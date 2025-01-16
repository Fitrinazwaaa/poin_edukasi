<?php

namespace App\Http\Controllers;

use App\Eksports\KelasEksport;
use App\Imports\KelasImport;
use App\Models\DataKelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        return view('admin.pengaturan.kelas.halaman_kelas', compact('kelasByTahun'));
    }

    public function create()
    {
        return view('admin.pengaturan.kelas.tambah_kelas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_angkatan' => 'required|numeric',
            'konsentrasi_keahlian' => 'required|string',
            'konsentrasi_keahlian_ke' => 'required|numeric|min:1',
        ]);
    
        try {
            $tahun_angkatan = $request->input('tahun_angkatan');
            $konsentrasi_keahlian = $request->input('konsentrasi_keahlian');
            $jumlahKelas = $request->input('konsentrasi_keahlian_ke');
    
            for ($i = 1; $i <= $jumlahKelas; $i++) {
                DataKelas::create([
                    'tahun_angkatan' => $tahun_angkatan,
                    'konsentrasi_keahlian' => $konsentrasi_keahlian,
                    'konsentrasi_keahlian_ke' => $i,
                ]);
            }
    
            return redirect()->route('kelas')->with('success', 'Data kelas berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

    public function EksportKelas()
    {
        return Excel::download(new KelasEksport, 'data_kelas.xlsx');
    }

    public function importKelas(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);
    
            // Proses impor file Excel
            \Maatwebsite\Excel\Facades\Excel::import(new KelasImport, $request->file('file'));
    
            return redirect()->route('kelas')
                             ->with('success', 'Data kelas berhasil diimpor dan diperbarui jika sudah ada.');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan saat impor :  ' . $e->getMessage());
        }
    }
    
}
