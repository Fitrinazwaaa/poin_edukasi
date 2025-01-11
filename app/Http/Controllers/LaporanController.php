<?php

namespace App\Http\Controllers;

use App\Eksports\LaporanEksport;
use App\Models\DataSiswa;
use App\Models\DataUser;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use DB;
use App\Models\PoinPelajar;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $datauser = DataUser::all();
    
        // Mulai dengan query PoinPelajar yang sudah terurut
        $query = PoinPelajar::orderBy('tingkatan')
                            ->orderBy('jurusan')
                            ->orderBy('jurusan_ke');
    
        // Cek jika ada pencarian berdasarkan kelas
        if ($request->has('kelas') && $request->kelas != '') {
            $kelas = $request->kelas;
            
            // Filter berdasarkan gabungan tingkatan, jurusan, dan jurusan_ke atau hanya jurusan
            $query->where(function($q) use ($kelas) {
                $q->where(DB::raw("CONCAT(tingkatan, ' ', jurusan, ' ', jurusan_ke)"), 'LIKE', "%$kelas%")
                  ->orWhere('jurusan', 'LIKE', "%$kelas%");
            });
        }
    
        // Cek pencarian berdasarkan NIS
        if ($request->has('nis') && $request->nis != '') {
            $query->where('nis', 'LIKE', "%{$request->nis}%");
        }
    
        // Cek pencarian berdasarkan Nama
        if ($request->has('nama') && $request->nama != '') {
            $query->where('nama', 'LIKE', "%{$request->nama}%");
        }
    
        // Cek pencarian berdasarkan jenis kelamin
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }
    
        // Cek pencarian berdasarkan bulan
        if ($request->has('bulan') && $request->bulan != '') {
            // Ambil bulan dan tahun dari input bulan (format YYYY-MM)
            $bulan = $request->bulan;
            $tahun = substr($bulan, 0, 4); // Ambil tahun (4 digit pertama)
            $bulan = substr($bulan, 5, 2); // Ambil bulan (2 digit setelah tanda '-')
            
            // Filter berdasarkan bulan dan tahun
            $query->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan);
        }
    
        // Ambil data poin pelajar dan kelompokkan berdasarkan NIS
        $poinPelajar = $query->get()->groupBy('nis');
    
        // Kembalikan data ke view
        return view('admin.laporan.laporan_poin_siswa', ['poinPelajar' => $poinPelajar], compact('datauser'));
    }
    
    

    public function downloadPdf(Request $request)
    {
        // Ambil data siswa
        $datasiswa = DataSiswa::all();
        
        // Mulai dengan query PoinPelajar yang sudah terurut
        $query = PoinPelajar::orderBy('tingkatan')
                            ->orderBy('jurusan')
                            ->orderBy('jurusan_ke');
        
        // Cek jika ada pencarian berdasarkan kelas
        if ($request->has('kelas') && $request->kelas != '') {
            $kelas = $request->kelas;
            
            // Filter berdasarkan gabungan tingkatan, jurusan, dan jurusan_ke atau hanya jurusan
            $query->where(function($q) use ($kelas) {
                $q->where(DB::raw("CONCAT(tingkatan, ' ', jurusan, ' ', jurusan_ke)"), 'LIKE', "%$kelas%")
                  ->orWhere('jurusan', 'LIKE', "%$kelas%");
            });
        }
    
        // Cek pencarian berdasarkan NIS
        if ($request->has('nis') && $request->nis != '') {
            $query->where('nis', 'LIKE', "%{$request->nis}%");
        }
    
        // Cek pencarian berdasarkan Nama
        if ($request->has('nama') && $request->nama != '') {
            $query->where('nama', 'LIKE', "%{$request->nama}%");
        }
    
        // Cek pencarian berdasarkan jenis kelamin
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }
    
        // Cek pencarian berdasarkan bulan
        if ($request->has('bulan') && $request->bulan != '') {
            // Ambil bulan dan tahun dari input bulan (format YYYY-MM)
            $bulan = $request->bulan;
            $tahun = substr($bulan, 0, 4); // Ambil tahun (4 digit pertama)
            $bulan = substr($bulan, 5, 2); // Ambil bulan (2 digit setelah tanda '-')
            
            // Filter berdasarkan bulan dan tahun
            $query->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan);
        }
    
        // Ambil data poin pelajar dan kelompokkan berdasarkan kelas (tingkatan, jurusan, jurusan_ke)
        $poinPelajar = $query->get()->groupBy(function($item) {
            return $item->tingkatan . ' ' . $item->jurusan . ' ' . $item->jurusan_ke;
        });
    
        // Hitung rentang tahun angkatan
        $tahunAngkatanMax = $datasiswa->max('tahun_angkatan');
    
        // Kirimkan data ke view PDF
        $pdf = PDF::loadView('admin.laporan.laporan_pdf', [
            'poinPelajar' => $poinPelajar,
            'tahunAngkatanMax' => $tahunAngkatanMax
        ]);
    
        return $pdf->download('laporan_poin_siswa.pdf');
    }

    public function downloadExcel()
    {
        return Excel::download(new LaporanEksport, 'Laporan_Poin_Siswa.xlsx');
    }
    
}
