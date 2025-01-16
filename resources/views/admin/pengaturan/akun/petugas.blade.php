@extends('navbar/nav-PengaturanAkun')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user4 Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <style>
        body{
            margin-top: -40px;
        }
        #user4-settings-container {
            background-color: #F0F4F9;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 50px 10px 10px 10px; /* Tambahkan padding atas untuk jarak */
        }

        #user4-settings-container .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            padding: 25px;
            width: 100%;
            max-width: 450px;
            position: relative;
        }

        #user4-settings-container .header {
            text-align: center;
            margin-bottom: 20px;
        }

        #user4-settings-container .profile-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #1e90ff;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-size: 36px;
            color: white;
        }

        #user4-settings-container .profile-text strong {
            font-size: 22px;
            display: block;
            margin-top: 10px;
        }

        #user4-settings-container .profile-text p {
            color: #555;
            font-size: 14px;
        }

        #user4-settings-container hr {
            border: 0;
            height: 1px;
            background-color: #388DD8;
            margin: 20px 0;
        }

        #user4-settings-container h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        #user4-settings-container label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        #user4-settings-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cfcfcf;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        #user4-settings-container button.btn {
            width: 100%;
            padding: 12px;
            background-color: #1e90ff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #user4-settings-container button.btn:hover {
            background-color: #1c86ee;
        }

        #user4-settings-container .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            display: none;
        }

        #user4-settings-container .secure-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            font-size: 12px;
            color: #555;
            text-align: center;
            margin-top: 20px;
        }

        #user4-settings-container .secure-info a {
            color: #1e90ff;
            text-decoration: none;
        }

        #user4-settings-container .secure-info a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="user4-settings-container">
        <div class="container">
            <div class="header">
                <div class="profile-icon">
                    <i class="fa fa-user"></i>
                </div>
                <div class="profile-text">
                    <strong id="profile-username">{{ $datauser->firstWhere('role', 'user4')->username ?? 'Penegak Disiplin' }}</strong>
                    <p>smkn1kawali@gmail.com</p>
                </div>
            </div>
            <hr>

            <!-- Alert -->
            <div id="alert-container" class="alert">
                Perubahan berhasil disimpan.
            </div>

            <h3 style="text-align: center;">Metode Masuk</h3>

            @foreach ($datauser as $user)
            @if ($user->role == 'user4')
            <form action="{{ route('UserUpdate', ['id' => $user->id]) }}" method="POST" onsubmit="return validateForm();">
                @csrf
                @method('PUT')

                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ $user->username }}" oninput="changeUsername()">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password baru">

                <button type="submit" class="btn">Ubah Akun</button>
            </form>
            @endif
            @endforeach

            <div class="secure-info">
                <p><strong>Amankan Akun Anda</strong></p>
                <p>Keamanan akun Anda adalah prioritas utama kami. Pastikan untuk menggunakan kata sandi yang kompleks, perbarui secara berkala, dan hindari berbagi informasi pribadi dengan pihak yang tidak dikenal.</p>
            </div>
        </div>
    </div>

    <script>
        function changeUsername() {
            var newUsername = document.getElementById("username").value;
            document.getElementById("profile-username").textContent = newUsername;
        }

        function validateForm() {
            var alertContainer = document.getElementById("alert-container");
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (!username || !password) {
                alertContainer.style.display = 'block';
                alertContainer.textContent = "Username dan password tidak boleh kosong.";
                return false; // Hentikan pengiriman form
            } else {
                alertContainer.style.display = 'block';
                alertContainer.textContent = "Perubahan berhasil disimpan.";
                return true; // Lanjutkan pengiriman form
            }
        }
    </script>
</body>

</html>
@endsection