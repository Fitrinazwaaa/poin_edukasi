<?php

namespace App\Imports;

use App\Models\DataKelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Session;
use Exception;

class KelasImport implements ToModel, WithHeadingRow, WithValidation
{
    private $expectedHeaders = [
        'id', 
        'tahun_angkatan', 
        'konsentrasi_keahlian', 
        'konsentrasi_keahlian_ke', 
        'dibuat_kosongkan', 
        'diperbaharui_kosongkan',
    ];

    /**
     * Proses data pada setiap baris.
     */
    public function model(array $row)
    {
        // Validasi header terlebih dahulu
        $this->validateHeaders($row);

        // Cek apakah data dengan ID tersebut sudah ada di database
        $existingKelas = DataKelas::find($row['id']);

        if ($existingKelas) {
            // Jika data sudah ada, lakukan update
            $existingKelas->update([
                'tahun_angkatan' => $row['tahun_angkatan'],
                'jurusan' => $row['konsentrasi_keahlian'],
                'jurusan_ke' => $row['konsentrasi_keahlian_ke'],
                'created_at' => $row['dibuat_kosongkan'] ?? $existingKelas->created_at,
                'updated_at' => $row['diperbaharui_kosongkan'] ?? now(),
            ]);

            // Set pesan sukses untuk update
            Session::flash('message', 'Data telah berhasil diperbarui!');

            // Kembalikan null karena kita hanya mengupdate data
            return null;
        }

        // Jika data tidak ada, buat entri baru
        return new DataKelas([
            'id' => $row['id'],
            'tahun_angkatan' => $row['tahun_angkatan'],
            'jurusan' => $row['konsentrasi_keahlian'],
            'jurusan_ke' => $row['konsentrasi_keahlian_ke'],
            'created_at' => $row['dibuat_kosongkan'] ?? now(),
            'updated_at' => $row['diperbaharui_kosongkan'] ?? now(),
        ]);
        
        // Set pesan sukses untuk tambah data baru
        Session::flash('message', 'Data telah berhasil ditambahkan!');
    }

    /**
     * Validasi header dari file Excel.
     */
    public function validateHeaders(array $row)
    {
        $fileHeaders = array_keys($row);
        $missingHeaders = array_diff($this->expectedHeaders, $fileHeaders);

        if (!empty($missingHeaders)) {
            $errorMessage = "Nama header pada tabel Excel tidak sesuai! "
                            . PHP_EOL . "- Header yang diharapkan :    ID, Tahun Angkatan, Konsentrasi Keahlian, Konsentrasi Keahlian Ke, Dibuat (kosongkan), Diperbaharui (kosongkan)."
                            . PHP_EOL . "- Header ditemukan :    " 
                            . implode(', ', $fileHeaders) . ".";
            throw new Exception($errorMessage);
        }      
    }

    /**
     * Aturan validasi untuk setiap baris data.
     */
    public function rules(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
            'unique' => 'Kolom :attribute sudah terdaftar.',
            'attributes' => [
                'ID' => 'ID',
                'Tahun Angkatan' => 'Tahun Angkatan',
                'Konsentrasi Keahlian' => 'Konsentrasi Keahlian',
                'Konsentrasi Keahlian Ke' => 'Konsentrasi Keahlian Ke',
                'Dibuat (kosongkan)' => 'Dibuat (kosongkan)',
                'Diperbaharui (kosongkan)' => 'Diperbaharui (kosongkan)',
            ],
        ];
    }

    /**
     * Pesan khusus untuk validasi.
     */
    public function customValidationMessages()
    {
        return [
            'id.required' => 'Kolom ID wajib diisi.',
            'id.numeric' => 'Kolom ID harus berupa angka.',
            'tahun_angkatan.required' => 'Kolom Tahun Angkatan wajib diisi.',
            'tahun_angkatan.numeric' => 'Kolom Tahun Angkatan harus berupa angka.',
            'konsentrasi_keahlian.required' => 'Kolom Konsentrasi Keahlian wajib diisi.',
            'konsentrasi_keahlian_ke.required' => 'Kolom Konsentrasi Keahlian Ke wajib diisi.',
            'dibuat_kosongkan.date' => 'Kolom Dibuat harus berupa tanggal yang valid.',
            'diperbaharui_kosongkan.date' => 'Kolom Diperbaharui harus berupa tanggal yang valid.',
        ];
    }

    /**
     * Mapping nama atribut untuk validasi.
     */
    public function customValidationAttributes()
    {
        return [
            'id' => 'ID',
            'tahun_angkatan' => 'Tahun Angkatan',
            'konsentrasi_keahlian' => 'Konsentrasi Keahlian',
            'konsentrasi_keahlian_ke' => 'Konsentrasi Keahlian Ke',
            'dibuat_kosongkan' => 'Dibuat (kosongkan)',
            'diperbaharui_kosongkan' => 'Diperbaharui (kosongkan)',
        ];
    }
}
