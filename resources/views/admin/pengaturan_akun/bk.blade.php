<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="{{ asset('css/admin/pengaturan_akun/bk.css') }}">
</head>

<body>
@extends('navbar/nav-PengaturanAkun')
    <div class="container">
        <div class="form-container">
            <div class="header">
                <h2>Pengaturan Profil Admin</h2>
                <br>
                <img src="https://cdn-icons-png.flaticon.com/512/7641/7641828.png" alt="" class="profile-icon" width="40" height="40">
                <div class="profile-text">
                <strong id="profile-username">
                    {{ optional($datauser->firstWhere('role', 'admin'))->username ?? 'BIMBINGAN KONSELING' }}
                </strong>
                    <p>{{ $datauser->firstWhere('role', 'admin')->email ?? 'smkn1kawali@gmail.com' }}</p>
                </div>
            </div>
            <br>
            <hr>
            <h3>Metode Masuk</h3>

            @foreach ($datauser as $user)
                @if ($user->role == 'admin')
                <form action="{{ route('UserUpdate', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Input Username -->
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ $user->username }}" oninput="changeUsername()">
                    <button type="submit" class="btn">Ganti Username</button>

                    <!-- Input Password -->
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password baru jika ingin mengganti">
                    <button type="submit" class="btn" onclick="return validatePassword()">Ganti Password</button> <!-- Ganti dengan onclick -->
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </form>
                @endif
            @endforeach

            <div class="secure-info">
                <p>Amankan Akun Anda</p>
                <p>Otentikasi dua faktor menambahkan lapisan keamanan ekstra ke akun Anda. Untuk masuk, Anda juga perlu memberikan kode 6 digit. Pelajari lebih lanjut.</p>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengganti username di tampilan profil
        function changeUsername() {
            var newUsername = document.getElementById("username").value;
            document.getElementById("profile-username").textContent = newUsername;
        }

        // Fungsi validasi password, akan menampilkan alert hanya jika tombol "Ganti Password" diklik
        function validatePassword() {
            var newPassword = document.getElementById("password").value;

            // Jika tidak ada password yang diisi, tidak perlu menampilkan notifikasi
            if (!newPassword) {
                return true; // Tetap kirim form meski password tidak diubah
            }

            // Jika password diisi, tampilkan pesan notifikasi (simulasi)
            alert("Password berhasil diubah ke: " + newPassword);
            return true; // Lanjutkan pengiriman form
        }
    </script>

</body>
</html>