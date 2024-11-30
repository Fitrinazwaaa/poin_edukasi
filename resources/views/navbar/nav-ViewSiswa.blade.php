<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Bootstrap Icons CDN -->
    <style>
        /* Navbar Custom Styling */
        .navbar-custom {
            padding: 0 110px;
            background-color: #388DD8;
            border-bottom: 2px solid white;
            height: 72px;
        }

        /* Back Button Styling */
        .back-button button {
            color: white;
            background: #388DD8;
            border: none;
            border-radius: 50%;
            padding: 2px 0;
            transition: all 0.3s ease;
        }

        .back-button .bi-arrow-left {
            font-size: 20px;
        }

        .back-button button:hover {
            background: #388DD8;
            transform: scale(1.1);
        }

        /* Profile Info Styling */
        .profile-info {
            display: flex;
            align-items: center;
            margin-left: 30px; /* Menambahkan jarak antara tombol kembali dan profil */
        }

        .profile-image img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .profile-details {
            margin-left: 10px;
            color: white;
        }

        .profile-id {
            font-size: 14px;
            font-weight: bold;
        }

        .profile-name {
            font-size: 16px;
            font-weight: bold;
        }

        /* Profile Meta Styling */
        .profile-meta {
            text-align: right;
            color: white;
        }

        .profile-gender,
        .profile-class {
            font-size: 14px;
            font-weight: bold;
        }

        /* Ensure content is not overlapped by navbar */
        .content {
            margin-top: 80px;
        }

        @media (max-width: 768px) {
    /* Navbar custom styling for mobile */
    .navbar-custom {
        padding: 0 10px;
        height: 67px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: nowrap;
    }

    /* Back button styling */
    .back-button {
        flex-shrink: 0; /* Pastikan ukuran tetap */
        margin-right: 10px; /* Beri jarak dengan elemen berikutnya */
    }

    /* Profile Info Styling */
    .profile-info {
        flex-grow: 1; /* Mengisi ruang kosong */
        display: flex;
        align-items: center;
        overflow: hidden; /* Menghindari teks terlalu panjang */
    }

    .profile-image img {
        width: 35px;
        height: 35px;
        margin-right: 8px; /* Jarak antara gambar dan detail */
    }

    .profile-details {
        overflow: hidden; /* Menyembunyikan teks yang panjang */
        white-space: nowrap; /* Teks tidak memotong baris */
        text-overflow: ellipsis; /* Tambahkan '...' jika teks terlalu panjang */
        max-width: 150px; /* Batasi panjang maksimum */
    }

    .profile-details .profile-name {
        font-size: 13px;
        font-weight: bold;
    }

    .profile-details .profile-id {
        font-size: 13px;
        color: white;
        text-align: left;
    }

    /* Profile Meta Styling */
    .profile-meta, .profile-details {
        flex-shrink: 0; /* Ukuran tetap, tidak ikut meregang */
        text-align: right;
        margin-left: 10px; /* Beri jarak dengan elemen sebelumnya */
        max-width: 100px; /* Batasi lebar pada profil meta */
    }

    .profile-meta .profile-class,
    .profile-details .profile-name {
        font-size: 13px;
        white-space: nowrap; /* Hindari pemotongan baris */
        text-overflow: ellipsis; /* Tambahkan '...' jika teks terlalu panjang */
        overflow: hidden; /* Sembunyikan teks yang melewati batas */
    }

/* Text Marquee Animation */
@keyframes marquee {
    0% {
        transform: translateX(110%);
    }
    100% {
        transform: translateX(-110%);
    }
}

/* Scrolling Text Container */
.scrolling-container {
    width: 150px;
    overflow: hidden;
    display: flex;
    align-items: center;
    padding-right: 30px; /* Tambahkan ruang ekstra */
}

/* Scrolling Text */
.scrolling-text {
    display: inline-block;
    white-space: nowrap;
    animation: marquee 10s linear infinite; /* Animasi terus-menerus */
    padding-right: 30px; /* Tambahkan ruang ekstra di akhir teks */
}


}

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-custom navbar-light fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Back button and Profile Info -->
            <div class="d-flex align-items-center">
                <!-- Back button -->
                <div class="back-button">
                    <button onclick="goBack()">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>

                <!-- Profile Info -->
                <div class="profile-info">
                    <div class="profile-image">
                        <img src="https://cdn-icons-png.flaticon.com/512/9449/9449194.png" alt="Profile Image">
                    </div>
                    <div class="profile-details">
                        <div class="profile-name scrolling-container"> 
                            <div class="scrolling-text">{{ $siswa->nama }} </div>
                        </div>
                        <div class="profile-id">{{ $siswa->nis }}</div>
                    </div>
                </div>
            </div>

            <!-- Profile Meta (right) -->
            <div class="profile-meta">
                <div class="profile-class scrolling-container">
                    <div class="scrolling-text">{{ $siswa->tingkatan }} {{ $siswa->jurusan }} {{ $siswa->jurusan_ke }} </div>
                </div>
                <div class="profile-gender">{{ $siswa->jenis_kelamin }}</div>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- JavaScript -->
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