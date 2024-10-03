<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 use App\Models\DataPoinPositif;
 use App\Models\DataPoinNegatif;
 use App\Models\PoinPeringatan;



class PoinController extends Controller
{
    // ////////
    public function index()
    {
        $poinPositif = DataPoinPositif::all();
        $poinNegatif = DataPoinNegatif::all(); 
        $poinPeringatan = PoinPeringatan::all(); 
        return view('admin.poin.halaman_poin', compact('poinPositif', 'poinNegatif', 'poinPeringatan')); // Mengirim kedua variabel
    }



    // ///////////
    public function create()
    {
        return view('admin/poin/tambah_poin');
    }



    // ////////////
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'np' => 'required|string|max:255',
            'id_poin' => 'required|integer',
            'type' => 'required|in:positive,negative',
            'poin' => 'required|integer',
            'kategori' => 'required|string|max:255',
        ]);

        // Cek tipe poin dari checkbox
        if ($request->input('type') == 'positive') {
            // Simpan ke tabel data_poin_positif
            DB::table('data_poin_positif')->insert([
                'np' => $validatedData['np'],
                'id_poin' => $validatedData['id_poin'],
                'poin' => $validatedData['poin'],
                'kategori' => $validatedData['kategori'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } elseif ($request->input('type') == 'negative') {
            // Simpan ke tabel data_poin_negatif
            DB::table('data_poin_negatif')->insert([
                'np' => $validatedData['np'],
                'id_poin' => $validatedData['id_poin'],
                'poin' => $validatedData['poin'],
                'kategori' => $validatedData['kategori'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('HalamanPoin');
    }



    // ////////
    public function edit(string $id)
    {
        $poinPeringatan = PoinPeringatan::findOrFail($id);

        return view('admin.poin.edit_peringatan', compact('poinPeringatan'));
    }
    
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'peringatan' => 'required|string|max:255',
            'max_poin' => 'required|integer',
        ]);
    
        PoinPeringatan::where('id_peringatan', $id)
            ->update($validatedData);
    
        return redirect()->route('HalamanPoin');
    }
    



    // /////////
    public function destroy(Request $request)
    {
        $ids_negatif = $request->input('ids_negatif'); // ambil id dari checkbox negatif
        $ids_positif = $request->input('ids_positif'); // ambil id dari checkbox positif

        if (!empty($ids_negatif)) {
            DataPoinNegatif::whereIn('id_poin', $ids_negatif)->delete(); // Hapus poin negatif yang dipilih
        }

        if (!empty($ids_positif)) {
            DataPoinPositif::whereIn('id_poin', $ids_positif)->delete(); // Hapus poin positif yang dipilih
        }

        // Set session untuk menentukan tabel yang aktif
        session(['active_table' => 'positif']); // Misalnya, kita ingin kembali ke tabel positif

        return redirect()->back()->with('success', 'Poin yang dipilih berhasil dihapus.');
    }

}