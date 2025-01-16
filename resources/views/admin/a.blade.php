<?php

    public function rules(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
            'unique' => 'Kolom :attribute sudah terdaftar.',
            'attributes' => [
                // 'id' => 'id',
                // 'Tahun Angkatan' => 'tahun_angkatan',
                // 'Konsentrasi Keahlian' => 'jurusan',
                // 'Konsentrasi Keahlian Ke' => 'jurusan_ke',
                // 'Dibuat (kosongkan)' => 'created_at',
                // 'Diperbaharui (kosongkan)' => 'updated_at',

                'ID' => 'ID',
                'Tahun Angkatan' => 'Tahun Angkatan',
                'Konsentrasi Keahlian' => 'Konsentrasi Keahlian',
                'Konsentrasi Keahlian Ke' => 'Konsentrasi Keahlian Ke',
                'Dibuat (kosongkan)' => 'Dibuat (kosongkan)',
                'Diperbaharui (kosongkan)' => 'Diperbaharui (kosongkan)',
                
                // 'id' => 'id',
                // 'tahun_angkatan' => 'Tahun Angkatan',
                // 'jurusan' => 'Konsentrasi Keahlian',
                // 'jurusan_ke' => 'Konsentrasi Keahlian Ke',
                // 'created_at' => 'Dibuat (kosongkan)',
                // 'updated_at' => 'Diperbaharui (kosongkan)',
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
            'unique' => 'Kolom :attribute sudah terdaftar.',
            'attributes' => [
                'id_poin_negatif' => 'id_poin_negatif',
                'nama_poin'       => 'nama_poin',
                'poin'            => 'poin',
                'kategori_poin'   => 'kategori_poin',
                'dibuat_kosongkan' => 'dibuat_kosongkan',
                'diperbaharui_kosongkan' => 'diperbaharui_kosongkan',
            ],
        ];
    }








Id Poin Negatif, Nama Poin, Poin, Kategori Poin, Dibuat (kosongkan), Diperbaharui (kosongkan)