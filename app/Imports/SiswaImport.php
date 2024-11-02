<?php

namespace App\Imports;

use App\Models\DataSiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cek jika NIS sudah ada
        $existingData = DataSiswa::where('nis', $row['nis'])->first();

        if ($existingData) {
            // Simpan pesan ke session untuk diambil di controller
            Session::flash('replace', [
                'nis' => $row['nis'],
                'nama' => $row['nama'],
            ]);
            
            // Gantikan data jika perlu
            // Untuk sekarang kita bisa kembalikan null dan menangani di controller
            return null; 
        }

        // Jika NIS tidak ada, buat data baru
        return new DataSiswa([
            'nis'  => $row['nis'], 
            'nama'  => $row['nama'], 
            'tingkatan'  => (int)$row['tingkatan'],
            'jurusan'  => $row['jurusan'], 
            'jurusan_ke'  => $row['jurusan_ke'], 
            'jenis_kelamin'  => $row['jenis_kelamin'], 
            'tahun_angkatan'  => $row['tahun_angkatan'],
        ]);
    }
}

