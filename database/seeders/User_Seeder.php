<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class User_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'username' => 'Bimbingan Konseling',
                'role'     => 'admin',
                'password' => bcrypt('000001'),
            ],
            [
                'username' => 'Kesiswaan',
                'role'     => 'user',
                'password' => bcrypt('000002'),
            ],
            [ 
                'username' => 'Guru',
                'role'     => 'user_edit',
                'password' => bcrypt('000003'),
            ],
            [
                'username' => 'OSIS',
                'role'     => 'user',
                'password' => bcrypt('000004'),
            ],
        ];

        foreach ($userData as $val) {
            User::create($val);
        }
    }
}
