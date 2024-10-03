<?php

namespace Database\Seeders;

use App\Models\PoinPeringatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PoinPeringatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poinPeringatan = [
            [
                'peringatan' => 'Teguran lisan',
                'max_poin'     => '12',
            ],
            [
                'peringatan' => 'Peringatan tertulis',
                'max_poin'     => '8',
            ],
            [ 
                'peringatan' => 'Peringatan tertulis disampaikan kepada orang tua',
                'max_poin'     => '22',
            ],
            [
                'peringatan' => 'Pemanggilan orang tua',
                'max_poin'     => '50',
            ],
            [
                'peringatan' => 'Siswa dan orang tua membuat surat perjanjian bermaterai',
                'max_poin'     => '75',
            ],
            [
                'peringatan' => 'Siswa di skors selama 3 hari',
                'max_poin'     => '100',
            ],
            [ 
                'peringatan' => 'Siswa di skors selama  hari',
                'max_poin'     => '135',
            ],
            [
                'peringatan' => 'Siswa dikembalikan kepada orang tua',
                'max_poin'     => '200',
            ],
        ];

        foreach ($poinPeringatan as $val) {
            PoinPeringatan::create($val);
        }
    }
}
