<?php

namespace App\Exports;

use App\Models\DataKelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KelasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DataKelas::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'tahun_angkatan',
            'jurusan',
            'jurusan_ke',
            'created_at',
            'updated_at',
        ];
    }
}
