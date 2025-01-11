<?php

namespace App\Http\Controllers;
use App\Models\PoinPelajar;
use Illuminate\Support\Facades\DB;

class Admin_Controller extends Controller
{
    public function admin()
    {
        $angkatan_data = PoinPelajar::select(
            'tahun_angkatan',
            DB::raw("CONCAT(tingkatan, ' ', jurusan, ' ', jurusan_ke) as kelas"),
            DB::raw("SUM(jumlah_negatif) as total_negatif")
        )
        ->groupBy('tahun_angkatan', 'tingkatan', 'jurusan', 'jurusan_ke')
        ->orderBy('tahun_angkatan')
        ->get();
    
        // Format data untuk Highcharts
        $grafik_data = $angkatan_data->groupBy('tahun_angkatan')->map(function ($data) {
            return $data->map(function ($item) {
                return [
                    'name' => $item->kelas,
                    'y' => $item->total_negatif,
                ];
            });
        });
        
        // dd($grafik_data);
        
        return view('admin.dashboard', [
            'grafik_data' => $grafik_data,
        ]);
    }
    
    public function user1()
    {
        $angkatan_data = PoinPelajar::select(
            'tahun_angkatan',
            DB::raw("CONCAT(tingkatan, ' ', jurusan, ' ', jurusan_ke) as kelas"),
            DB::raw("SUM(jumlah_negatif) as total_negatif")
        )
        ->groupBy('tahun_angkatan', 'tingkatan', 'jurusan', 'jurusan_ke')
        ->orderBy('tahun_angkatan')
        ->get();
    
        // Format data untuk Highcharts
        $grafik_data = $angkatan_data->groupBy('tahun_angkatan')->map(function ($data) {
            return $data->map(function ($item) {
                return [
                    'name' => $item->kelas,
                    'y' => $item->total_negatif,
                ];
            });
        });
        
        // dd($grafik_data);
        
        return view('admin.dashboard', [
            'grafik_data' => $grafik_data,
        ]);
    }
    
    public function user2()
    {
        $angkatan_data = PoinPelajar::select(
            'tahun_angkatan',
            DB::raw("CONCAT(tingkatan, ' ', jurusan, ' ', jurusan_ke) as kelas"),
            DB::raw("SUM(jumlah_negatif) as total_negatif")
        )
        ->groupBy('tahun_angkatan', 'tingkatan', 'jurusan', 'jurusan_ke')
        ->orderBy('tahun_angkatan')
        ->get();
    
        // Format data untuk Highcharts
        $grafik_data = $angkatan_data->groupBy('tahun_angkatan')->map(function ($data) {
            return $data->map(function ($item) {
                return [
                    'name' => $item->kelas,
                    'y' => $item->total_negatif,
                ];
            });
        });
        
        // dd($grafik_data);
        
        return view('admin.dashboard', [
            'grafik_data' => $grafik_data,
        ]);
    }
    
    public function user3()
    {
        $angkatan_data = PoinPelajar::select(
            'tahun_angkatan',
            DB::raw("CONCAT(tingkatan, ' ', jurusan, ' ', jurusan_ke) as kelas"),
            DB::raw("SUM(jumlah_negatif) as total_negatif")
        )
        ->groupBy('tahun_angkatan', 'tingkatan', 'jurusan', 'jurusan_ke')
        ->orderBy('tahun_angkatan')
        ->get();
    
        // Format data untuk Highcharts
        $grafik_data = $angkatan_data->groupBy('tahun_angkatan')->map(function ($data) {
            return $data->map(function ($item) {
                return [
                    'name' => $item->kelas,
                    'y' => $item->total_negatif,
                ];
            });
        });
        
        // dd($grafik_data);
        
        return view('admin.dashboard', [
            'grafik_data' => $grafik_data,
        ]);
    }
    
    public function user4()
    {
        $angkatan_data = PoinPelajar::select(
            'tahun_angkatan',
            DB::raw("CONCAT(tingkatan, ' ', jurusan, ' ', jurusan_ke) as kelas"),
            DB::raw("SUM(jumlah_negatif) as total_negatif")
        )
        ->groupBy('tahun_angkatan', 'tingkatan', 'jurusan', 'jurusan_ke')
        ->orderBy('tahun_angkatan')
        ->get();
    
        // Format data untuk Highcharts
        $grafik_data = $angkatan_data->groupBy('tahun_angkatan')->map(function ($data) {
            return $data->map(function ($item) {
                return [
                    'name' => $item->kelas,
                    'y' => $item->total_negatif,
                ];
            });
        });
        
        // dd($grafik_data);
        
        return view('admin.dashboard', [
            'grafik_data' => $grafik_data,
        ]);
    }
    
    public function user_edit()
    {
        $angkatan_data = PoinPelajar::select(
            'tahun_angkatan',
            DB::raw("CONCAT(tingkatan, ' ', jurusan, ' ', jurusan_ke) as kelas"),
            DB::raw("SUM(jumlah_negatif) as total_negatif")
        )
        ->groupBy('tahun_angkatan', 'tingkatan', 'jurusan', 'jurusan_ke')
        ->orderBy('tahun_angkatan')
        ->get();
    
        // Format data untuk Highcharts
        $grafik_data = $angkatan_data->groupBy('tahun_angkatan')->map(function ($data) {
            return $data->map(function ($item) {
                return [
                    'name' => $item->kelas,
                    'y' => $item->total_negatif,
                ];
            });
        });
        
        // dd($grafik_data);
        
        return view('admin.dashboard', [
            'grafik_data' => $grafik_data,
        ]);
    }
    
    public function index()
    {
        $angkatan_data = PoinPelajar::select(
            'tahun_angkatan',
            DB::raw("CONCAT(tingkatan, ' ', jurusan, ' ', jurusan_ke) as kelas"),
            DB::raw("SUM(jumlah_negatif) as total_negatif")
        )
        ->groupBy('tahun_angkatan', 'tingkatan', 'jurusan', 'jurusan_ke')
        ->orderBy('tahun_angkatan')
        ->get();
    
        // Format data untuk Highcharts
        $grafik_data = $angkatan_data->groupBy('tahun_angkatan')->map(function ($data) {
            return $data->map(function ($item) {
                return [
                    'name' => $item->kelas,
                    'y' => $item->total_negatif,
                ];
            });
        });
        
        // dd($grafik_data);
        
        return view('admin.dashboard', [
            'grafik_data' => $grafik_data,
        ]);
    }


    public function contoh()
    {
        $angkatan_data = PoinPelajar::select(
            'tahun_angkatan',
            DB::raw("CONCAT(tingkatan, ' ', jurusan, ' ', jurusan_ke) as kelas"),
            DB::raw("SUM(jumlah_negatif) as total_negatif")
        )
        ->groupBy('tahun_angkatan', 'tingkatan', 'jurusan', 'jurusan_ke')
        ->orderBy('tahun_angkatan')
        ->get();
    
        // Format data untuk Highcharts
        $grafik_data = $angkatan_data->groupBy('tahun_angkatan')->map(function ($data) {
            return $data->map(function ($item) {
                return [
                    'name' => $item->kelas,
                    'y' => $item->total_negatif,
                ];
            });
        });
        
        // dd($grafik_data);
        
        return view('admin.a', [
            'grafik_data' => $grafik_data,
        ]);
    }
}