<?php

namespace App\Imports;

use App\Models\DataSiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Update atau buat data baru berdasarkan NIS
        DataSiswa::updateOrCreate(
            ['nis' => $row['nis']],  // Kondisi untuk menemukan data yang cocok berdasarkan NIS
            [
                'nama' => $row['nama'],
                'tingkatan' => (int)$row['tingkatan'],
                'jurusan' => $row['jurusan'],
                'jurusan_ke' => $row['jurusan_ke'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'tahun_angkatan' => $row['tahun_angkatan'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
            ]
        );

        // Kembalikan null karena kita tidak perlu mengembalikan instance baru
        return null;
    }
}
