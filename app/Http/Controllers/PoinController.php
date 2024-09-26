<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 use App\Models\DataPoinPositif;
 use App\Models\DataPoinNegatif;


class PoinController extends Controller
{
    public function index()
    {
        $poinPositif = DataPoinPositif::all();
        $poinNegatif = DataPoinNegatif::all(); 

        return view('admin.poin.halaman_poin', compact('poinPositif', 'poinNegatif')); // Mengirim kedua variabel
    }

    public function create()
    {
        return view('admin/poin/tambah_poin');
    }

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
}