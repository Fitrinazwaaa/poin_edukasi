<?php

namespace App\Exports;

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

class PoinExportGabungan implements WithMultipleSheets
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
        return DataPoinPositif::orderBy('nama_poin', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'id_poin_positif',
            'nama_poin',
            'poin',
            'kategori_poin',
            'created_at',
            'updated_at',
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
        return DataPoinNegatif::orderBy('nama_poin', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'id_poin_negatif',
            'nama_poin',
            'poin',
            'kategori_poin',
            'created_at',
            'updated_at',
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