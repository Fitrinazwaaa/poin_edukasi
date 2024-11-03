<?php

namespace App\Imports;

use App\Models\DataPoinNegatif;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PoinNegatifImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari data berdasarkan id_poin_negatif
        $dataNegatif = DataPoinNegatif::updateOrCreate(
            ['id_poin_negatif' => $row['id_poin_negatif']], // Kondisi untuk menentukan data yang ada
            [
                'nama_poin'     => $row['nama_poin'],
                'poin'          => $row['poin'],
                'kategori_poin' => $row['kategori_poin'],
                'created_at'    => $row['created_at'],
                'updated_at'    => $row['updated_at'],
            ]
        );

        return $dataNegatif;
    }
}
