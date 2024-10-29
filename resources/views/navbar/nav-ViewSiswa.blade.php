<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/navbar/nav-ViewSiswa.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-custom navbar-light fixed-top">
        <div class="container-fluid">
            <!-- Back button -->
            <div class="back-button">
                <button onclick="goBack()">
                    <i class="bi bi-arrow-left"></i> <!-- Bootstrap Icons -->
                </button>
            </div>

            <!-- Profile Info (centered) -->
            <div class="profile-info">
                <div class="profile-image">
                    <img src="https://cdn-icons-png.flaticon.com/512/9449/9449194.png" alt="Profile Image">
                </div>
                <div class="profile-details">
                    <div class="profile-id">{{ $siswa->nis }}</div>
                    <div class="profile-name">{{ $siswa->nama }}</div>
                </div>
            </div>

            <!-- Profile Meta (right) -->
            <div class="profile-meta">
                <div class="profile-gender">{{ $siswa->jenis_kelamin }}</div>
                <div class="profile-class">{{ $siswa->tingkatan }} {{ $siswa->jurusan }} {{ $siswa->jurusan_ke }}</div>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Tambahkan JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        // Function to go back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
