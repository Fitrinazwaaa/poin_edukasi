<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Admin_Controller extends Controller
{
    public function index()
    {
        return view('main');
    }
    public function admin()
    {
        return view('admin/siswa/siswa');
    }
    public function user1()
    {
        return view('user1/laporan_poin_siswa');
    }
    public function user2()
    {
        return view('user2/laporan_poin_siswa');
    }
    public function user_edit()
    {
        return view('user_edit/SiswaPoin');
    }
}
