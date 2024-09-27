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
    @extends('navbar/nav-form')
    <div class="hero">
        <div class="judul-awal">
            <p class="judul1">TABEL PEROLEHAN POIN NEGATIF & POIN POSITIF SISWA SMKN 1 KAWALI</p>
            <p class="judul2">PERIODE 2022-2024<p>
        </div>
        <div class="button-container">
            <button class="notification-btn">
                Teguran Lisan
                <span class="notification-count">5</span>
            </button>
            <button class="notification-btn">
                Peringatan Tertulis
                <span class="notification-count">3</span>
            </button>
            <button class="notification-btn">
                Peringatan Tertulis Orang Tua
                <span class="notification-count">2</span>
            </button>
            <button class="notification-btn">
                Pemanggilan Orang Tua
                <span class="notification-count">4</span>
            </button>
            <button class="notification-btn">
                Surat Perjanjian Bermaterai
                <span class="notification-count">1</span>
            </button>
            <button class="notification-btn">
                Siswa Skors 3 Hari
                <span class="notification-count">0</span>
            </button>
            <button class="notification-btn">
                Siswa Skors 6 Hari
                <span class="notification-count">1</span>
            </button>
            <button class="notification-btn">
                Rekomendasi Kesiswaan
                <span class="notification-count">2</span>
            </button>
        </div>        
        <button class="tambah" onclick="window.location.href='{{ route('TipePoinSiswa') }}';">
            <img src="https://cdn-icons-png.flaticon.com/512/1237/1237946.png" alt="add" width="13" height="13">    Tambahkan
        </button>
        <div class="tabel1">
            <div>
                <a class="btn btn-primary dropdown-toggle" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin-top: 10px">
                    ANGKATAN 2022 - 2023
                </a>
            </div>
            <div class="collapse" id="collapseExample1">
                <div class="satu"></div>
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
        <div class="tabel2">
            <div>
                <a class="btn btn-primary dropdown-toggle" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin-top:20px">
                    ANGKATAN 2023 - 2024
                </a>
            </div>
            <div class="collapse" id="collapseExample2">
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
                            <!-- Tambahkan baris lain sesuai kebutuhan -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tabel3">
            <div>
                <a class="btn btn-primary dropdown-toggle" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample" style="margin-top:20px">
                    ANGKATAN 2024 - 2025
                </a>
            </div>
            <div class="collapse" id="collapseExample3">
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
                            <!-- Tambahkan baris lain sesuai kebutuhan -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>