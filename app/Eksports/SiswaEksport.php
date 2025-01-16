<?php
namespace App\Eksports;

use App\Models\DataSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SiswaEksport implements FromCollection, WithHeadings, WithMultipleSheets
{
    public function collection()
    {
        // Logic untuk mengembalikan data koleksi, misalnya:
        return DataSiswa::all();
    }

    public function headings(): array
    {
        return [
            'NIS', 
            'Nama', 
            'Tingkatan',
            'Konsentrasi Keahlian', 
            'Konsentrasi Keahlian Ke', 
            'Jenis Kelamin', 
            'Tahun Angkatan',
            'Dibuat (kosongkan)',
            'Diperbaharui (kosongkan)',
        ];
    }
    public function sheets(): array
    {
        $sheets = [];

        // Ambil semua tahun angkatan unik dari database
        $tahunAngkatan = DataSiswa::select('tahun_angkatan')->distinct()->pluck('tahun_angkatan');

        // Buat satu sheet untuk setiap tahun angkatan
        foreach ($tahunAngkatan as $tahun) {
            $sheets[] = new SiswaPerAngkatanEksport($tahun);
        }

        return $sheets;
    }
}

