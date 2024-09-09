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
        return view('admin/poin_siswa/SiswaPoin');
    }
    public function user()
    {
        return view('user/laporan_data_siswa');
    }
    public function user_edit()
    {
        return view('user_edit/SiswaPoin');
    }
}
