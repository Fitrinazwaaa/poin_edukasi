<?php

namespace App\Imports;

use App\Models\DataPoinPositif;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PoinPositifImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
    
        $dataPositif = DataPoinPositif::updateOrCreate(
            ['id_poin_positif' => $row['id_poin_positif']],
            [
                'nama_poin'     => $row['nama_poin'],
                'poin'          => $row['poin'],
                'kategori_poin' => $row['kategori_poin'],
                'created_at'    => $row['created_at'],
                'updated_at'    => $row['updated_at'],
            ]
        );
    
        return $dataPositif;
    }
    
}
