<?php

namespace App\Eksports;

use App\Models\DataKelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KelasEksport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DataKelas::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tahun Angkatan',
            'Konsentrasi Keahlian',
            'Konsentrasi Keahlian Ke',
            'Dibuat (kosongkan)',
            'Diperbaharui (kosongkan)',
        ];
    }
}
