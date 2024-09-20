<?php

namespace Database\Seeders;

use App\Models\poin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poinData = [
            [
                'keteranganID' => '1001',
                'keterangan'     => 'Senin-Selasa tidak berpakaian PSAS (baju putih-celana/rok abu), “kerudung putih” bagi perempuan',
                'tipe' => 'negatif',
            ],
            [
                'keteranganID' => '1002',
                'keterangan'     => 'Senin-Selasa tidak berkaos kaki putih',
                'tipe' => 'negatif',
            ],
            [ 
                'keteranganID' => '1003',
                'keterangan'     => 'renking satu',
                'tipe' => 'positif',
            ],
            [
                'keteranganID' => '1004',
                'keterangan'     => 'hafalan 10 surat',
                'tipe' => 'positif',
            ],
        ];

        // Insert the data into the poin table
        foreach ($poinData as $val) {
            poin::create($val);
        }
    }
}
