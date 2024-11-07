<?php
namespace App\Imports;

use App\Models\DataKelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KelasImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cek jika kelas dengan id yang sama sudah ada
        $existingKelas = DataKelas::find($row['id']);

        if ($existingKelas) {
            // Jika ada, update data yang sudah ada
            $existingKelas->update([
                'tahun_angkatan' => $row['tahun_angkatan'],
                'jurusan' => $row['jurusan'],
                'jurusan_ke' => $row['jurusan_ke'],
            ]);
            return null; // Return null untuk menghindari penambahan record baru
        }

        // Jika tidak ada, buat data baru
        return new DataKelas([
            'id' => $row['id'], // Pastikan id ini disertakan dalam Excel yang di-upload
            'tahun_angkatan' => $row['tahun_angkatan'],
            'jurusan' => $row['jurusan'],
            'jurusan_ke' => $row['jurusan_ke'],
        ]);
    }
}
