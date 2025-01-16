<?php

namespace App\Imports;

use App\Models\DataSiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Session;
use Exception;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Header yang diharapkan
     */
    private $expectedHeaders = [
        'nis', 
        'nama', 
        'tingkatan', 
        'konsentrasi_keahlian', 
        'konsentrasi_keahlian_ke', 
        'jenis_kelamin', 
        'tahun_angkatan', 
        'dibuat_kosongkan', 
        'diperbaharui_kosongkan',
    ];

    /**
     * Memasukkan data ke model atau melakukan update jika data dengan NIS sudah ada
     */
    public function model(array $row)
    {
        // Validasi header terlebih dahulu
        $this->validateHeaders($row);

        // Mencari data berdasarkan NIS, jika ada lakukan update, jika tidak create baru
        $existingSiswa = DataSiswa::where('nis', $row['nis'])->first();

        if ($existingSiswa) {
            // Jika data dengan NIS yang sama sudah ada, hanya update yang diubah
            $existingSiswa->update([
                'nama' => $row['nama'],
                'tingkatan' => (int)$row['tingkatan'],
                'jurusan' => $row['konsentrasi_keahlian'],
                'jurusan_ke' => $row['konsentrasi_keahlian_ke'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'tahun_angkatan' => $row['tahun_angkatan'],
                'updated_at' => $row['diperbaharui_kosongkan'] ?? now(), // hanya update 'updated_at'
            ]);

            // Set pesan sukses untuk update
            Session::flash('message', 'Data telah berhasil diperbarui!');
            return null; // Tidak perlu create data baru jika sudah ada
        }

        // Jika data belum ada, buat data baru
        DataSiswa::create([
            'nis' => $row['nis'],
            'nama' => $row['nama'],
            'tingkatan' => (int)$row['tingkatan'],
            'jurusan' => $row['konsentrasi_keahlian'],
            'jurusan_ke' => $row['konsentrasi_keahlian_ke'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tahun_angkatan' => $row['tahun_angkatan'],
            'created_at' => $row['dibuat_kosongkan'] ?? now(),
            'updated_at' => $row['diperbaharui_kosongkan'] ?? now(),
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
                            . PHP_EOL . "- Header yang diharapkan :    NIS, Nama, Tingkatan, Konsentrasi Keahlian, Konsentrasi Keahlian Ke, Jenis Kelamin, Tahun Angkatan, Dibuat (kosongkan), Diperbaharui (kosongkan)."
                            . PHP_EOL . "- Header ditemukan :    " 
                            . implode(', ', $fileHeaders) . ".";
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
                'nis' => 'NIS',
                'Nama' => 'Nama',
                'Tingkatan' => 'Tingkatan',
                'Konsentrasi Keahlian' => 'Konsentrasi Keahlian',
                'Konsentrasi Keahlian Ke' => 'Konsentrasi Keahlian Ke',
                'Jenis Kelamin' => 'Jenis Kelamin',
                'Tahun Angkatan' => 'Tahun Angkatan',
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
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nama.required' => 'Kolom Nama wajib diisi.',
            'tingkatan.required' => 'Kolom Tingkatan wajib diisi.',
            'tingkatan.numeric' => 'Kolom Tingkatan harus berupa angka.',
            'konsentrasi_keahlian.required' => 'Kolom Konsentrasi Keahlian wajib diisi.',
            'konsentrasi_keahlian_ke.required' => 'Kolom Konsentrasi Keahlian Ke wajib diisi.',
            'jenis_kelamin.required' => 'Kolom Jenis kelamin wajib diisi.',
            'tahun_angkatan.required' => 'Kolom Tahun angkatan wajib diisi.',
            'tahun_angkatan.numeric' => 'Kolom Tahun angkatan harus berupa angka.',
            'dibuat_kosongkan.date' => 'Kolom Dibuat harus berupa tanggal yang valid.',
            'diperbaharui_kosongkan.date' => 'Kolom Diperbaharui harus berupa tanggal yang valid.',
        ];
    }

    /**
     * Mapping nama atribut untuk validasi
     */
    public function customValidationAttributes()
    {
        return [
            'nis' => 'NIS',
            'nama' => 'Nama',
            'tingkatan' => 'Tingkatan',
            'konsentrasi_keahlian' => 'Konsentrasi Keahlian',
            'konsentrasi_keahlian_ke' => 'Konsentrasi Keahlian Ke',
            'jenis_kelamin' => 'Jenis kelamin',
            'tahun_angkatan' => 'Tahun angkatan',
            'dibuat_kosongkan' => 'Dibuat (kosongkan)',
            'diperbaharui_kosongkan' => 'Diperbaharui (kosongkan)',
        ];
    }
}
