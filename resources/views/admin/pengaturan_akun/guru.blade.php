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
                <h2>Pengaturan Profil User Edit</h2>
                <br>
                <img src="https://cdn-icons-png.flaticon.com/512/7641/7641828.png" alt="" class="profile-icon" width="40" height="40">
                <div class="profile-text">
                    <strong id="profile-username">{{ $datauser->firstWhere('role', 'user_edit')->username ?? 'GURU' }}</strong>
                    <p>{{ $datauser->firstWhere('role', 'user_edit')->email ?? 'smkn1kawali@gmail.com' }}</p>
                </div>
            </div>
            <br>
            <hr>
            <h3>Metode Masuk</h3>

            @foreach ($datauser as $user)
                @if ($user->role == 'user_edit')
                <form action="{{ route('UserUpdate', ['id' => $user->id]) }}" method="POST"> <!-- Tambahkan ID pengguna -->
                    @csrf
                    @method('PUT')
                    
                    <!-- Input Username -->
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ $user->username }}" oninput="changeUsername()"> <!-- Event listener 'oninput' untuk sinkronisasi -->
                    <button type="submit" class="btn">Ganti Username</button> <!-- Tambahkan onclick -->


                    <!-- Input Password -->
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password baru jika ingin mengganti">
                    <button type="submit" class="btn">Ganti Password</button> <!-- Tambahkan onclick -->
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
        // Fungsi untuk mengganti username
        function changeUsername() {
            // Ambil nilai dari input username
            var newUsername = document.getElementById("username").value;
            // Perbarui teks username di bawah ikon profil
            document.getElementById("profile-username").textContent = newUsername;
        }

        // Fungsi untuk mengganti password
        function changePassword() {
            // Ambil nilai dari input password
            var newPassword = document.getElementById("password").value;
            // Simpan atau perbarui password (di sini hanya untuk simulasi)
            alert("Password berhasil diubah ke: " + newPassword);
        }
    </script>

</body>
</html>