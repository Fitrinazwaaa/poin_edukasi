<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Method untuk menampilkan semua akun
    public function indexbk()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();
        return view('admin.pengaturan_akun.bk', compact('datauser'));
    }
    public function indexguru()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();
        return view('admin.pengaturan_akun.guru', compact('datauser'));
    }
    public function indexosis()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();
        return view('admin.pengaturan_akun.osis', compact('datauser'));
    }
    public function indexkesiswaan()
    {
        // Ambil semua data user dari database
        $datauser = DataUser::all();
        return view('admin.pengaturan_akun.kesiswaan', compact('datauser'));
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

        // Update username
        $pengguna->username = $request->input('username');

        // Jika ada password baru, update password (dienkripsi)
        if ($request->input('password')) {
            $pengguna->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan ke database
        $pengguna->save();

        // Redirect dengan pesan sukses
        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    
}