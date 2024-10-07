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


    public function notifikasi1()
    {
        return view('admin/poin_siswa/notifikasi/PemanggilanOrangTua');
    }
    public function notifikasi2()
    {
        return view('admin/poin_siswa/notifikasi/PeringatanTertulis');
    }
    public function notifikasi3()
    {
        return view('admin/poin_siswa/notifikasi/PeringatanTertulisOrangTua');
    }
    public function notifikasi4()
    {
        return view('admin/poin_siswa/notifikasi/RekomendasiKesiswaan');
    }
    public function notifikasi5()
    {
        return view('admin/poin_siswa/notifikasi/SiswaSkors3hari');
    }
    public function notifikasi6()
    {
        return view('admin/poin_siswa/notifikasi/SiswaSkors6hari');
    }
    public function notifikasi7()
    {
        return view('admin/poin_siswa/notifikasi/SuratPerjanjianBermaterai');
    }
    public function notifikasi8()
    {
        return view('admin/poin_siswa/notifikasi/TeguranLisan');
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
