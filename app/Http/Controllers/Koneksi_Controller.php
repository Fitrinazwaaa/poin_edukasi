<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Koneksi_Controller extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Informasi login menggunakan username dan password
        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // Cek kredensial menggunakan Auth
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'admin') {
                return redirect('admin');
            } elseif (Auth::user()->role == 'user1') {
                return redirect('/user_kesiswaan');
            } elseif (Auth::user()->role == 'user2') {
                return redirect('/user_osis');
            } elseif (Auth::user()->role == 'user_edit') {
                return redirect('user_edit');
            }
            // Jika login sukses
            return redirect('admin');
        } else {
            // Jika login gagal, kirimkan pesan kesalahan
            return back()->withErrors([
                'loginError' => 'Username dan password yang anda masukkan tidak sesuai.',
            ]);
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}

