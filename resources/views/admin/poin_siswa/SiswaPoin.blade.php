<!DOCTYPE html>
<html lang="en">
<head>
    <meta chars style="display: flex; justify-content: center; align-items: center;"et="UTF-8">
    <meta name="view Moreport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/poin_siswa/SiswaPoin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    @if (Auth::user()->role == 'user_edit')
    <script>
        window.location.href = "{{ route('GuruPage') }}";
        </script>
    @elseif (Auth::user()->role == 'user1')
    <script>
        window.location.href = "{{ route('KesiswaanPage') }}";
        </script>
    @elseif (Auth::user()->role == 'user2')
    <script>
        window.location.href = "{{ route('OsisPage') }}";
        </script>
    @elseif (Auth::user()->role == 'admin')
    
    {{-- NAVBAR - START --}}
    <nav class="navbar navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation" style="margin-left:5%;">
                <span an class="navbar-toggler-icon"></span>
            </button>
            @if (Auth::user()->role == 'admin')
                <h5 class="offcanvas-title" style="margin-left:5%;">Bimbingan Konseling</h5>
            @endif
            @if (Auth::user()->role == 'user')
                <h5>Kesiswaan</h5>
            @endif
            @if (Auth::user()->role == 'user')
                <h5>Osis</h5>
            @endif
            @if (Auth::user()->role == 'user_edit')
                <h5>Guru</h5>
            @endif
            <form action="" class="search-bar" style="margin-right:3%;">
                <input type="search" name="search" pattern=".*\S.*" required>
            <button class="search-btn" type="submit">
                <span>Search</span>
            </button>
            </form>
            <div data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="margin-left:5%;">Menu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <hr>
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Data Siswa</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Poin Siswa</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Keterangan Dan Jenis Poin</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Laporan Akhir Semester</a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Pengaturan Akun</a>
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

    <div class="tabel2">
        <div>
            <a class="btn btn-primary dropdown-toggle" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin-top: 90px;">
                Angkatan Tahun 2023 -2024
            </a>
        </div>
        <div class="collapse" id="collapseExample1">
            <div class="card card-body">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Jenis <br> Kelamin</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Negatif</th>
                            <th>Positif</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>222310392</td>
                            <td>Alinda Eka Yuniarti</td>
                            <td>
                                <div class="gender-box-wrapper">
                                <div class="gender-box female">P</div>
                            </td>
                                <td>12 RPL 3</td>
                                <td>Rekayasa Perangkat Lunak</td>
                                <td>10</td>
                                <td>20</td>
                                <td style="display: flex; justify-content: center; align-items: center;">
                                    <button class="add-btn">View More</button>
                                </td>
                            </tr>
                            <tr>
                            <td>2</td>
                                <td>222310393</td>
                                <td>Nurdin</td>
                                <td><div class="gender-box male">L</div></td>
                                <td>12 RPL 1</td>
                                <td>Rekayasa Perangkat Lunak</td>
                                <td>15</td>
                                <td>7</td>
                                <td style="display: flex; justify-content: center; align-items: center;">
                                <button class="add-btn">View More</button>
                                </td>
                            </tr>
                        <tr>
                            <td>3</td>
                            <td>222310392</td>
                            <td>Alinda Eka Yuniarti</td>
                            <td><div class="gender-box-wrapper">
                            <div class="gender-box female">P</div></td>
                            <td>12 RPL 3</td>
                            <td>Rekayasa Perangkat Lunak</td>
                            <td>65</td>
                            <td>77</td>
                            <td style="display: flex; justify-content: center; align-items: center;">
                            <button class="add-btn">View More</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>222310392</td>
                            <td>Alinda Eka Yuniarti</td>
                            <td><div class="gender-box-wrapper">
                            <div class="gender-box female">P</div></td>
                            <td>12 RPL 3</td>
                            <td>Rekayasa Perangkat Lunak</td>
                            <td>8</td>
                            <td>38</td>
                            <td style="display: flex; justify-content: center; align-items: center;">
                            <button class="add-btn">View More</button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>222310393</td>
                            <td>Nurdin</td>
                                <td><div class="gender-box male">L</div></td>
                                <td>12 RPL 1</td>
                                <td>Rekayasa Perangkat Lunak</td>
                                <td>70</td>
                                <td>35</td>
                                <td style="display: flex; justify-content: center; align-items: center;">
                                <button class="add-btn">View More</button>
                                </td>
                            </tr>
                        <tr>
                            <td>6</td>
                            <td>222310392</td>
                            <td>Alinda Eka Yuniarti</td>
                            <td><div class="gender-box-wrapper">
                            <div class="gender-box female">P</div></td>
                            <td>12 RPL 3</td>
                            <td>Rekayasa Perangkat Lunak</td>
                            <td>4</td>
                            <td>30</td>
                            <td style="display: flex; justify-content: center; align-items: center;">
                            <button class="add-btn">View More</button>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                                <td>222310393</td>
                                <td>Nurdin</td>
                                <td><div class="gender-box male">L</div></td>
                                <td>12 RPL 1</td>
                                <td>Rekayasa Perangkat Lunak</td>
                                <td>90</td>
                                <td>4</td>
                                <td style="display: flex; justify-content: center; align-items: center;">
                                <button class="add-btn">View More</button>
                                </td>
                            </tr>
                            <tr>
                            <td>8</td>
                                <td>222310393</td>
                                <td>Nurdin</td>
                                <td><div class="gender-box male">L</div></td>
                                <td>12 RPL 1</td>
                                <td>Rekayasa Perangkat Lunak</td>
                                <td>90</td>
                                <td>30</td>
                                <td style="display: flex; justify-content: center; align-items: center;">
                                <button class="add-btn">View More</button>
                                </td>
                            </tr>
                        <tr>
                            <td>9</td>
                            <td>222310392</td>
                            <td>Alinda Eka Yuniarti</td>
                            <td><div class="gender-box-wrapper">
                            <div class="gender-box female">P</div></td>
                            <td>12 RPL 3</td>
                            <td>Rekayasa Perangkat Lunak</td>
                            <td>10</td>
                            <td>8</td>
                            <td style="display: flex; justify-content: center; align-items: center;">
                            <button class="add-btn">View More</button>
                            </td>
                        </tr>
                        
                        <!-- Tambahkan baris lain sesuai kebutuhan -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>