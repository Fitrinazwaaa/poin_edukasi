<?php
namespace App\Exports;

use App\Models\PoinPelajar;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromArray, WithHeadings, WithStyles
{
    public function array(): array
    {
        $poinPelajar = PoinPelajar::orderBy('tingkatan')
            ->orderBy('jurusan')
            ->orderBy('jurusan_ke')
            ->get()
            ->groupBy('nis');
    
        $data = [];
        $index = 1;
    
        foreach ($poinPelajar as $groupedData) {
            $poinPertama = $groupedData->first();
    
            // Menghitung poin positif dan negatif
            $poinPositif = $groupedData->where('poin_positif', '>', 0);
            $poinNegatif = $groupedData->where('poin_negatif', '>', 0);
    
            // Baris untuk poin positif
            $data[] = [
                'NO' => $index,
                'NIS' => $poinPertama->nis,
                'NAMA' => $poinPertama->nama,
                'JENIS KELAMIN' => $poinPertama->jenis_kelamin,
                'KELAS' => "{$poinPertama->tingkatan} {$poinPertama->jurusan} {$poinPertama->jurusan_ke}",
                'POINT' => $poinPositif->count() > 0 ? "Positif: {$poinPositif->sum('poin_positif')}" : '-',
                'KETERANGAN' => $poinPositif->count() > 0 
                    ? $poinPositif->map(function($item, $key) {
                        return ($key + 1) . ". " . $item->nama_poin_positif;
                    })->implode("\n") 
                    : '-',
                'WAKTU' => $poinPositif->count() > 0 
                    ? $poinPositif->map(function($item, $key) {
                        return ($key + 1) . ". " . $item->created_at->format('d-m-Y');
                    })->implode("\n") 
                    : '-',
            ];
    
            // Baris untuk poin negatif
            $data[] = [
                'NO' => '',
                'NIS' => '',
                'NAMA' => '',
                'JENIS KELAMIN' => '',
                'KELAS' => '',
                'POINT' => $poinNegatif->count() > 0 ? "Negatif: {$poinNegatif->sum('poin_negatif')}" : '-',
                'KETERANGAN' => $poinNegatif->count() > 0 
                    ? $poinNegatif->map(function($item, $key) {
                        return ($key + 1) . ". " . $item->nama_poin_negatif;
                    })->implode("\n") 
                    : '-',
                'WAKTU' => $poinNegatif->count() > 0 
                    ? $poinNegatif->map(function($item, $key) {
                        return ($key + 1) . ". " . $item->created_at->format('d-m-Y');
                    })->implode("\n") 
                    : '-',
            ];
    
            $index++;
        }
    
        return $data;
    }
    

    public function headings(): array
    {
        return [
            'NO',
            'NIS',
            'NAMA',
            'JENIS KELAMIN',
            'KELAS',
            'POINT',
            'KETERANGAN',
            'WAKTU'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur gaya header
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['rgb' => '4F81BD'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ]
        ]);

        // Menambahkan border untuk seluruh data
        $sheet->getStyle('A1:H' . ($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000'],
                ]
            ],
        ]);

        // Mengatur lebar kolom dan mengaktifkan wrap text untuk kolom keterangan dan waktu
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(10);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(10);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(15);

        $sheet->getStyle('G')->getAlignment()->setWrapText(true);
        $sheet->getStyle('H')->getAlignment()->setWrapText(true);

        // Memusatkan teks di beberapa kolom
        $sheet->getStyle('A:F')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A:H')->getAlignment()->setVertical('center');
    }
}
