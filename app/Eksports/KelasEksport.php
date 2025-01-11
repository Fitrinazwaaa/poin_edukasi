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
            'id',
            'tahun_angkatan',
            'jurusan',
            'jurusan_ke',
            'created_at',
            'updated_at',
        ];
    }
}
