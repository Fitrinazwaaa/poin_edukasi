<?php
namespace App\Exports;

use App\Models\DataSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
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
            'Kelas',
            'Jenis Kelamin',
            'Tahun Angkatan',
        ];
    }
}

