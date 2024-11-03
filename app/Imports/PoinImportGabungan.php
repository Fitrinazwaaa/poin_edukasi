<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PoinImportGabungan implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            // Tentukan sheet untuk poin positif dan negatif
            'Poin Positif' => new PoinPositifImport(),
            'Poin Negatif' => new PoinNegatifImport(),
        ];
    }
}
