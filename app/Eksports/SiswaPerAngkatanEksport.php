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
            'nis',
            'nama',
            'tingkatan',
            'jurusan',
            'jurusan_ke',
            'jenis_kelamin',
            'tahun_angkatan',
            'created_at',
            'updated_at',
        ];
    }

    public function title(): string
    {
        // Kembalikan nama sheet berdasarkan tahun angkatan
        return 'Angkatan ' . $this->tahunAngkatan;
    }
}
