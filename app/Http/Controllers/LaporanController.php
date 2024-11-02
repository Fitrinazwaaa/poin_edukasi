<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\PoinPelajar;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengurutkan dan mengelompokkan berdasarkan NIS
        $poinPelajar = PoinPelajar::orderBy('tingkatan')
                                   ->orderBy('jurusan')
                                   ->orderBy('jurusan_ke')
                                   ->get()
                                   ->groupBy('nis');
    
        return view('admin.laporan.laporan_poin_siswa', ['poinPelajar' => $poinPelajar]);
    }
    

    public function downloadPdf()
    {
        $poinPelajar = PoinPelajar::orderBy('tingkatan')
            ->orderBy('jurusan')
            ->orderBy('jurusan_ke')
            ->get()
            ->groupBy(function($item) {
                return $item->tingkatan . ' ' . $item->jurusan . ' ' . $item->jurusan_ke;
            });
    
        $pdf = PDF::loadView('admin.laporan.laporan_pdf', ['poinPelajar' => $poinPelajar]);
        return $pdf->download('laporan_poin_siswa.pdf');
    }

    public function downloadExcel()
    {
        return Excel::download(new LaporanExport, 'Laporan_Poin_Siswa.xlsx');
    }
    
}
