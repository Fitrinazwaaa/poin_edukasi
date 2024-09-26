<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa; // Menggunakan model DataSiswa
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
    
        // Mengirim data ke view
        return view('admin.siswa.siswa', compact('siswaByTahun'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.siswa.tambah_siswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DataSiswa::create($request->all());
        return redirect()->route('Siswa');
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
        $data = DataSiswa::where('nis', $id)
            ->update([
                'nis'               => $request->input('nis'),
                'nama'              => $request->input('nama'),
                'jenis_kelamin'     => $request->input('jenis_kelamin'),
                'kelas'             => $request->input('kelas'),
                'tahun_angkatan'    => $request->input('tahun_angkatan'), // Perbaiki penamaan ini
            ]);
    
        return redirect()->route('Siswa');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroyMultiple(Request $request)
    {
        // Validate the request to ensure at least one NIS is provided
        $request->validate([
            'nis' => 'required|array',
            'nis.*' => 'exists:data_siswa,nis', // Ensure each NIS exists in the database
        ]);
    
        // Delete the students with the specified NIS
        DataSiswa::whereIn('nis', $request->nis)->delete();
    
        return redirect()->route('Siswa')->with('success', 'Siswa yang dipilih berhasil dihapus.');
    }
    

}
