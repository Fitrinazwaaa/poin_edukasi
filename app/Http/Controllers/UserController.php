<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    // Method untuk menampilkan semua akun
    public function indexbk()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();
        return view('admin.pengaturan.akun.bk', compact('datauser'));
    }

    public function indexguru()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();
        return view('admin.pengaturan.akun.guru', compact('datauser'));
    }
    public function indexosis()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();
        return view('admin.pengaturan.akun.osis', compact('datauser'));
    }

    public function indexsiswa()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();
        return view('admin.pengaturan.akun.siswa', compact('datauser'));
    }

    public function indexpetugas()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();
        return
         view('admin.pengaturan.akun.petugas', compact('datauser'));
    }
    public function indexkesiswaan()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();
        return view('admin.pengaturan.akun.kesiswaan', compact('datauser'));
    }

    // Method untuk mengedit berdasarkan ID user
    public function edit(string $id)
    {
        // Cari user berdasarkan ID
        $pengguna = DataUser::findOrFail($id);
        return view('admin.pengaturan_akun.edit', compact('pengguna'));
    }

    // Method untuk update akun berdasarkan ID
    public function update(Request $request, string $id)
    {
        // Validasi input data
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', // Password bisa kosong
        ]);

        // Cari user berdasarkan ID
        $pengguna = DataUser::findOrFail($id);

        // Cek apakah role yang diedit adalah admin
        $isAdmin = $pengguna->role === 'admin';

        // Update username
        $pengguna->username = $request->input('username');

        // Jika ada password baru, update password (dienkripsi)
        if ($request->input('password')) {
            $pengguna->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan ke database
        $pengguna->save();

        // Jika yang diedit adalah admin, logout dan arahkan ke login
        if ($isAdmin) {
            Auth::logout(); // Logout pengguna
            return redirect('/')->with('info', 'Profil berhasil diperbarui. Silakan login kembali.');
        }

        // Redirect dengan pesan sukses jika bukan admin
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}