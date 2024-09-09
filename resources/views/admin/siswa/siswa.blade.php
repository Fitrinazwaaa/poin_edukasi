<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/siswa/siswa.css') }}">
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

    <div class="tabel1">
        <div>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin-top: 100px;">
                Angkatan Tahun 2022 - 2023
            </a>
        </div>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <table>
                    <tr>
                        <th>NO</th>
                        <th>NIS</th>
                        <th>NAMA</th>
                        <th>JENIS KELAMIN</th>
                        <th>KELAS</th>
                        <th>JURUSAN</th>
                        <th>ANGKATAN TAHUN</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>