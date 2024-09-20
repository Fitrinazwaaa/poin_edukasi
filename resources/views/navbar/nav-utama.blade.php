<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/navbar/nav-utama.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    @if (Auth::user()->role == 'user_edit')
    {{-- NAVBAR - START --}}
    <nav class="navbar navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left:5%;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h5 class="offcanvas-title" style="margin-left:20px;">Guru</h5>
            <form action="" class="search-bar" style="margin-right:3%;">
                <input type="search" name="search" pattern=".*\S.*" required>
                <button class="search-btn" type="submit">
                    <span>Search</span>
                </button>
            </form>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left:5%;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h5 class="offcanvas-title" style="margin-left:20px;">Kesiswaan</h5>
            <form action="" class="search-bar" style="margin-right:3%;">
                <input type="search" name="search" pattern=".*\S.*" required>
                <button class="search-btn" type="submit">
                    <span>Search</span>
                </button>
            </form>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left:5%;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h5 class="offcanvas-title" style="margin-left:20px;">Osis</h5>
            <form action="" class="search-bar" style="margin-right:3%;">
                <input type="search" name="search" pattern=".*\S.*" required>
                <button class="search-btn" type="submit">
                    <span>Search</span>
                </button>
            </form>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left:5%;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h5 class="offcanvas-title" style="margin-left:5%;">Bimbingan Konseling</h5>
            <form action="" class="search-bar" style="margin-right:3%;">
                <input type="search" name="search" pattern=".*\S.*" required>
                <button class="search-btn" type="submit">
                    <span>Search</span>
                </button>
            </form>
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
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('AkunBK') }}">Pengaturan Akun</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
