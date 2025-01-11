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
                'role'     => 'user1',
                'password' => bcrypt('000002'),
            ],
            [ 
                'username' => 'Guru',
                'role'     => 'user_edit',
                'password' => bcrypt('000003'),
            ],
            [
                'username' => 'OSIS',
                'role'     => 'user2',
                'password' => bcrypt('000004'),
            ],
            [
                'username' => 'Siswa',
                'role'     => 'user3',
                'password' => bcrypt('000005'),
            ],
            [
                'username' => 'Penegak Disiplin',
                'role'     => 'user4',
                'password' => bcrypt('000006'),
            ]
        ];

        foreach ($userData as $val) {
            User::create($val);
        }
    }
}
