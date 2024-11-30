<?php

namespace App\Http\Controllers;

 use App\Exports\PoinExportGabungan;
 use App\Imports\PoinImport;
 use App\Imports\PoinImportGabungan;
 use App\Imports\PoinImportNegatif;
 use App\Imports\PoinImportPositif;
 use App\Exports\PoinExportNegatif;
 use App\Exports\PoinExportPositif;
 use Barryvdh\DomPDF\Facade\Pdf;
 use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 use App\Models\DataPoinPositif;
 use App\Models\DataPoinNegatif;
use App\Models\DataUser;
use App\Models\PoinPeringatan;
 use Maatwebsite\Excel\Facades\Excel;

class PoinController extends Controller
{
    public function index()
    {
        $datauser = DataUser::all();
        $poinNegatif = DataPoinNegatif::orderBy('kategori_poin', 'asc')->get();
    
        // Mengambil dan mengurutkan data poin positif berdasarkan kategori
        $poinPositif = DataPoinPositif::orderBy('kategori_poin', 'asc')->get();
        $poinPeringatan = PoinPeringatan::all(); 
        return view('admin.poin.halaman_poin', compact('poinPositif', 'poinNegatif', 'poinPeringatan', 'datauser')); // Mengirim kedua variabel
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
                'nama_poin' => $validatedData['np'],
                'id_poin_positif' => $validatedData['id_poin'],
                'poin' => $validatedData['poin'],
                'kategori_poin' => $validatedData['kategori'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } elseif ($request->input('type') == 'negative') {
            // Simpan ke tabel data_poin_negatif
            DB::table('data_poin_negatif')->insert([
                'nama_poin' => $validatedData['np'],
                'id_poin_negatif' => $validatedData['id_poin'],
                'poin' => $validatedData['poin'],
                'kategori_poin' => $validatedData['kategori'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('HalamanPoin');
    }

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

    public function destroy(Request $request)
    {
        // Hapus data berdasarkan pilihan checkbox negatif
        if ($request->has('ids_negatif')) {
            DataPoinNegatif::whereIn('id_poin_negatif', $request->ids_negatif)->delete();
        }
    
        // Hapus data berdasarkan pilihan checkbox positif
        if ($request->has('ids_positif')) {
            DataPoinPositif::whereIn('id_poin_positif', $request->ids_positif)->delete();
        }
    
        return redirect()->route('HalamanPoin')->with('success', 'Data berhasil dihapus');
    }
    
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        // Mengimpor file yang diunggah
        Excel::import(new PoinImportGabungan, $request->file('file'));

        return redirect()->back()->with('success', 'Data Poin berhasil diimpor.');
    }
    
    
    public function exportGabungan()
    {
        return Excel::download(new PoinExportGabungan, 'poin_positif_dan_negatif.xlsx');
    }

    public function exportPDF()
    {
        
        // Ambil data dari model Anda
        $dataPoinPositif = DataPoinPositif::all(); // Data poin positif
        $dataPoinNegatif = DataPoinNegatif::all(); // Data poin negatif
    
        // Buat instance PDF dan load view
        $pdf = PDF::loadView('admin.poin.poin_pdf', [
            'dataPoinPositif' => $dataPoinPositif,
            'dataPoinNegatif' => $dataPoinNegatif,
        ]);
    
        // Kembalikan file PDF untuk diunduh
        return $pdf->download('poin.pdf');
    }
    
    
}