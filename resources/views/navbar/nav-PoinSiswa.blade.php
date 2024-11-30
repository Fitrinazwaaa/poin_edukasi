<?php

use App\Models\DataUser;

$datauser = DataUser::all();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* NAVBAR-START */

/* Mengatur lebar navbar offcanvas saat dalam posisi start (kiri) */
div#offcanvasDarkNavbar.offcanvas.offcanvas-start {
    width: 270px;
    font-size: 14px;
}

/* Mengatur warna latar belakang navbar offcanvas */
.offcanvas.offcanvas-start {
    background-color: #388DD8;
}

/* Mengatur warna latar belakang navbar bagian atas */
.navbar {
    background-color: #388DD8;
    position: fixed;
    height: 65px;
}

/* Mengatur warna teks judul navbar menjadi putih */
.offcanvas-title {
    color: white;
    font-size: 17px;
}

/* Memberi padding di sebelah kiri setiap item dalam navbar */
li.nav-item {
    padding-left: 15px;
}

/* Mengatur warna garis pemisah dalam menu navbar menjadi putih dan tanpa margin */
ul hr {
    color: white;
    margin: 0;
}

/* Mengatur padding tautan navbar */
a.nav-link {
    padding: 15px 0;
}

/* Mengubah tampilan item navbar saat di-hover dengan menambahkan bayangan dan mengubah warna latar belakang */
.offcanvas ul li:hover {
    box-shadow: 0 0.5px 5px rgba(0, 0, 0, 0.192);
    background: #1676ca;
    border-style: solid;
    border-color: #ffffff;
    border-width: 5px;
    border-right: black;
    border-top: black;
    border-bottom: black;
}

/* Mengatur warna tautan navbar menjadi putih saat di-hover */
.offcanvas ul li .nav-link:hover {
    color: white;
}

div.satu{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 100%;
    height: 54px;
}

h5.offcanvas-title{
    margin-left: 20px;
}

/* Menghapus padding default pada body offcanvas */
div.offcanvas-body {
    padding-top: 0;
    text-align: left !important;
}

/* Menambahkan padding bawah pada header offcanvas */
div.offcanvas-header {
    padding-bottom: 10px;
}

/* NAVBAR-END */

/* Navbar Custom Styling */
.navbar-custom {
    padding: 0 50px;
    background-color: #388DD8;
    border-bottom: 2px solid white;
    height: 72px;
    display: flex;
    align-items: center;
}

/* Back Button Styling */
.back-button {
    display: flex;
    align-items: center;
}

.back-button button {
    color: white;
    background: #388DD8;
    border: none;
    border-radius: 50%;
    padding: 5px 10px;
    transition: all 0.3s ease;
    font-weight: bold; /* Set bold to match h5 */
}



/* Hover effect on back button */
.back-button button:hover {
    background: #388DD8;
    transform: scale(1.1);
}

/* Teks H5 di sebelah kanan tombol back */
.navbar-custom h5 {
    color: white;
    margin-left: 15px;
    margin-bottom: 0;
}

/* Ensure content is not overlapped by navbar */
.content {
    margin-top: 80px;
}
    /* Custom styling for dropdown items */

    
    /* Mengatur tampilan item dropdown saat di-hover */
    .dropdown-item {
        color: white; /* Warna teks */
        transition: background-color 0.3s ease; /* Tambahkan transisi agar lebih halus */
        padding: 15px 0;
    }

/* Mengatur warna dropdown sesuai dengan warna "Pengaturan" */
.nav-item.dropdown:hover .dropdown-menu {
    background-color: #1676ca;
}

/* Warna default dropdown menu */
.dropdown-menu {
    background-color: #388DD8; /* Warna default */
    border: none;
    box-shadow: none;
}

/* Item dropdown saat di-hover */
.dropdown-item:hover {
    background: #1676ca; /* Warna saat di-hover */
    color: white;
    border-style: solid;
    border-color: #1676ca;
    border-width: 10px;
    border-right: black;
    border-top: black;
    border-bottom: black;
}
    </style>
</head>
<body>
    @if (Auth::user()->role == 'user_edit')
    {{-- NAVBAR - START --}}
    <nav class="navbar navbar-dark fixed-top">
        <div class="container-fluid">
            <div class="satu">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left:5%;">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h5 class="offcanvas-title" style="margin-left:20px;">POIN SISWA SMKN 1 KAWALI</h5>
            </div>
            <div data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-backdrop="false" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="margin-left:5%;">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('PoinSiswa') }}">Poin Siswa</a>
                            </li>
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout">Keluar Akun</a>
                            </li>
                            <hr>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    {{-- NAVBAR - END --}}

    @elseif (Auth::user()->role == 'user1')
    {{-- NAVBAR - START --}}
    <nav class="navbar navbar-dark fixed-top">
        <div class="container-fluid">
            <div class="satu">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left:5%;">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h5 class="offcanvas-title" style="margin-left:20px;">POIN SISWA SMKN 1 KAWALI</h5>
            </div>
            <div data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-backdrop="false" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="margin-left:5%;">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('LaporanPoinSiswa') }}">Laporan Akhir Semester</a>
                            </li>
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout">Keluar Akun</a>
                            </li>
                            <hr>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    {{-- NAVBAR - END --}}

    @elseif (Auth::user()->role == 'user2')
    
    {{-- NAVBAR - START --}}
    <nav class="navbar navbar-dark fixed-top">
        <div class="container-fluid">
            <div class="satu">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left:5%;">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h5 class="offcanvas-title" style="margin-left:20px;">POIN SISWA SMKN 1 KAWALI</h5>
            </div>
            <div data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-backdrop="false" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="margin-left:5%;">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('LaporanPoinSiswa') }}">Laporan Akhir Semester</a>
                            </li>
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout">Keluar Akun</a>
                            </li>
                            <hr>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    {{-- NAVBAR - END --}}

    @elseif (Auth::user()->role == 'admin')
{{-- NAVBAR - START --}}
<nav class="navbar navbar-dark fixed-top">
    <div class="container-fluid">
        <div class="satu">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left:5%;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h5 class="offcanvas-title" style="margin-left:5%;">DATA SISWA SMKN 1 KAWALI</h5>
        </div>
        <div data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas offcanvas-start" tabindex="-1" data-bs-backdrop="false" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="margin-left:5%;">Menu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('Siswa') }}">Data Siswa</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('PoinSiswa') }}">Poin Siswa</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('HalamanPoin') }}">Keterangan Dan Jenis Poin</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('LaporanPoinSiswa') }}">Laporan Akhir Semester</a>
                        </li>
                        <hr>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pengaturan
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
                                <hr>
                                <a class="dropdown-item" aria-current="page" href="{{ route('AkunBK') }}" style="font-size: 14px; font-weight: 300;"><strong id="profile-username">{{ $datauser->firstWhere('role', 'admin')->username ?? 'Bimbingan Konseling' }}</strong></a>
                                <hr>
                                <a class="dropdown-item" aria-current="page" href="{{ route('AkunGuru') }}" style="font-size: 14px; font-weight: 300;"><strong id="profile-username">{{ $datauser->firstWhere('role', 'user_edit')->username ?? 'Guru' }}</strong></a>
                                <hr>
                                <a class="dropdown-item" aria-current="page" href="{{ route('AkunOsis') }}" style="font-size: 14px; font-weight: 300;"><strong id="profile-username">{{ $datauser->firstWhere('role', 'user1')->username ?? 'Kesiswaan' }}</strong></a>
                                <hr>
                                <a class="dropdown-item" aria-current="page" href="{{ route('AkunKesiswaan') }}" style="font-size: 14px; font-weight: 300;"><strong id="profile-username">{{ $datauser->firstWhere('role', 'user2')->username ?? 'OSIS' }}</strong></a>
                                <hr>
                                <a class="dropdown-item" aria-current="page" href="{{ route('kelas') }}" style="font-size: 14px;" >Kelas</a>
                            </div>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Keluar Akun</a>
                        </li>
                        <hr>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
    {{-- NAVBAR - END --}}
    @endif

        <!-- Main content -->
        <div class="content">
        @yield('content')
    </div>

    <!-- Tambahkan JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>