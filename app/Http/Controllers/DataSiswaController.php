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
        return $data;
        // return view('admin.siswa.edit_siswa', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
