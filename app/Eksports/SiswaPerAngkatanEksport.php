<?php

namespace App\Eksports;

use App\Models\DataSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SiswaPerAngkatanEksport implements FromCollection, WithHeadings, WithTitle
{
    private $tahunAngkatan;

    public function __construct($tahunAngkatan)
    {
        $this->tahunAngkatan = $tahunAngkatan;
    }

    public function collection()
    {
        // Ambil data siswa berdasarkan tahun angkatan
        return DataSiswa::where('tahun_angkatan', $this->tahunAngkatan)->get();
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

    public function title(): string
    {
        // Kembalikan nama sheet berdasarkan tahun angkatan
        return 'Angkatan ' . $this->tahunAngkatan;
    }
}
