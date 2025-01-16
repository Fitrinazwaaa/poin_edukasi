<?php

namespace App\Imports;

use App\Models\DataPoinNegatif;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Session;
use Exception;

class PoinNegatifImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Header yang diharapkan
     */
    private $expectedHeaders = [
        'id_poin_negatif', 
        'nama_poin', 
        'poin', 
        'kategori_poin', 
        'dibuat_kosongkan', 
        'diperbaharui_kosongkan',
    ];

    /**
     * Memasukkan data ke model atau melakukan update jika data dengan id_poin_negatif sudah ada
     */
    public function model(array $row)
    {
        // Validasi header terlebih dahulu
        $this->validateHeaders($row);
        
        // Proses penyimpanan atau pembaruan
        $existingData = DataPoinNegatif::find($row['id_poin_negatif']);
        if ($existingData) {
            $existingData->update([
                'nama_poin'     => $row['nama_poin'],
                'poin'          => $row['poin'],
                'kategori_poin' => $row['kategori_poin'],
                'created_at'    => $row['dibuat_kosongkan'] ?? $existingData->created_at,
                'updated_at'    => $row['diperbaharui_kosongkan'] ?? now(),
            ]);
            // Set pesan sukses untuk update
            Session::flash('message', 'Data telah berhasil diperbarui!');
            return null;
        }

        // Insert baru
        return new DataPoinNegatif([
            'id_poin_negatif' => $row['id_poin_negatif'],
            'nama_poin'       => $row['nama_poin'],
            'poin'            => $row['poin'],
            'kategori_poin'   => $row['kategori_poin'],
            'created_at'      => $row['dibuat_kosongkan'] ?? now(),
            'updated_at'      => $row['diperbaharui_kosongkan'] ?? now(),
        ]);
        // Set pesan sukses untuk tambah data baru
        Session::flash('message', 'Data telah berhasil ditambahkan!');
    }
    

    /**
     * Fungsi untuk validasi header
     */
    public function validateHeaders(array $row)
    {
        // Mendapatkan header dari file Excel
        $fileHeaders = array_keys($row);

        // Periksa apakah header sesuai
        $missingHeaders = array_diff($this->expectedHeaders, $fileHeaders);
        $incorrectHeaders = array_diff($fileHeaders, $this->expectedHeaders);

        if (!empty($missingHeaders)) {
            $errorMessage = "Nama header pada tabel Excel tidak sesuai! "
                            . PHP_EOL . "- Header yang diharapkan : Id Poin Negatif, Nama Poin, Poin, Kategori Poin, Dibuat (kosongkan), Diperbaharui (kosongkan)"
                            . PHP_EOL . "- Header ditemukan : " . implode(', ', $fileHeaders) . ".";
            throw new Exception($errorMessage);
        }      
    }

    /**
     * Menentukan baris header
     */
    public function headingRow(): int
    {
        return 1; // Baris header berada di baris pertama
    }

    /**
     * Aturan validasi untuk setiap baris data
     */
    public function rules(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
            'unique' => 'Kolom :attribute sudah terdaftar.',
            'attributes' => [
                'Id Poin Negatif' => 'Id Poin Negatif',
                'Nama Poin'       => 'Nama Poin',
                'Poin'            => 'Poin',
                'Kategori Poin'   => 'Kategori Poin',
                'Dibuat (kosongkan)' => 'Dibuat (kosongkan)',
                'Diperbaharui (kosongkan)' => 'Diperbaharui (kosongkan)',
            ],
        ];
    }

    /**
     * Pesan kesalahan validasi khusus
     */
    public function customValidationMessages()
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'unique' => 'Kolom :attribute sudah terdaftar.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            'id_poin_negatif' => 'Id Poin Negatif',
            'nama_poin' => 'Nama Poin',
            'poin' => 'Poin',
            'kategori_poin' => 'Kategori Poin',
            'dibuat_kosongkan' => 'Dibuat (kosongkan)',
            'diperbaharui_kosongkan' => 'Diperbaharui (kosongkan)',
        ];
    }
}
