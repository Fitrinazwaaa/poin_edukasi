<?php

namespace App\Eksports;

use App\Models\DataPoinPositif;
use App\Models\DataPoinNegatif;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PoinEksportGabungan implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new PoinPositifSheet(),
            new PoinNegatifSheet(),
        ];
    }
}

class PoinPositifSheet implements FromCollection, WithTitle, WithStyles, WithHeadings
{
    public function collection()
    {
        // Data disusun berdasarkan kategori dan nama poin
        return DataPoinPositif::orderBy('kategori_poin', 'asc')
            ->orderBy('nama_poin', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Id Poin Positif',
            'Nama Poin',
            'Poin',
            'Kategori Poin',
            'Dibuat (kosongkan)',
            'Diperbaharui (kosongkan)',
        ];
    }

    public function title(): string
    {
        return 'Poin Positif'; // Nama sheet untuk tabel positif
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF0070C0', // Warna biru
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Atur lebar kolom
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}

class PoinNegatifSheet implements FromCollection, WithTitle, WithStyles, WithHeadings
{
    public function collection()
    {
        // Data disusun berdasarkan kategori dan nama poin
        return DataPoinNegatif::orderBy('kategori_poin', 'asc')
            ->orderBy('nama_poin', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Id Poin Negatif',
            'Nama Poin',
            'Poin',
            'Kategori Poin',
            'Dibuat (kosongkan)',
            'Diperbaharui (kosongkan)',
        ];
    }

    public function title(): string
    {
        return 'Poin Negatif'; // Nama sheet untuk tabel negatif
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF0070C0', // Warna biru
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Atur lebar kolom
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
