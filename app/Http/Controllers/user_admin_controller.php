<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class user_admin_controller extends Controller
{
    
    public function laporan1()
    {
        return view('admin/laporan/laporan_poin_siswa');
    }

    
    public function pengaturan_akun1()
    {
        return view('admin/pengaturan_akun/bk');
    }
    public function pengaturan_akun2()
    {
        return view('admin/pengaturan_akun/guru');
    }
    public function pengaturan_akun3()
    {
        return view('admin/pengaturan_akun/kesiswaan');
    }
    public function pengaturan_akun4()
    {
        return view('admin/pengaturan_akun/osis');
    }


    public function edit()
    {
        return view('admin/poin/edit_peringatan');
    }

    
    public function siswa1()
    {
        return view('admin/siswa/edit_siswa');
    }
    public function siswa2()
    {
        return view('admin/siswa/siswa');
    }
    public function siswa3()
    {
        return view('admin/siswa/tambah_siswa');
    }


    public function jurusan1()
    {
        return view('admin/jurusan/jurusan');
    }
    public function jurusan2()
    {
        return view('admin/jurusan/tambah_jurusan');
    }
}
