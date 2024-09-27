<!DOCTYPE html>
<html lang="en">
<head>
    <meta chars style="display: flex; justify-content: center; align-items: center;"et="UTF-8">
    <meta name="view Moreport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/laporan/laporan_poin_siswa.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    @extends('navbar/nav-form')

    <table class="table table-bordered">
        <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIS</th>
                            <th>NAMA</th>
                            <th>JENIS KELAMIN</th>
                            <th>KELAS</th>
                            <th>JURUSAN</th>
                            <th>POINT</th>
                            <th>KETERANGAN</th>
                            <th>WAKTU</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="2">1</td>
                            <td rowspan="2">222310923</td>
                            <td rowspan="2">ALINDA EKA YUNIARTI</td>
                            <td  rowspan="2"><div class="gender-box-wrapper">
                            <div class="gender-box female">P</div></td>
                            <td rowspan="2">RPL 3</td>
                            <td rowspan="2">REKAYASA PERANGKAT LUNAK</td>
                            <td>POSITIF : 10</td>
                            <td>
                                <ul>
                                    <li>ranking 1 di kelas</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>20-08-2023</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Negatif</td>
                            <td>
                                <ul>
                                    <li>kaos kaki tidak sesuai hari</li>
                                    <li>memakai make up</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>22-09-2023</li>
                                    <li>11-04-2023</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">1</td>
                            <td rowspan="2">222310923</td>
                            <td rowspan="2">ALINDA EKA YUNIARTI</td>
                            <td rowspan="2"><div class="gender-box male">L</div></td>
                            <td rowspan="2">RPL 3</td>
                            <td rowspan="2">REKAYASA PERANGKAT LUNAK</td>
                            <td>POSITIF : 10</td>
                            <td>
                                <ul>
                                    <li>ranking 1 di kelas</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>20-08-2023</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Negatif</td>
                            <td>
                                <ul>
                                    <li>kaos kaki tidak sesuai hari</li>
                                    <li>memakai make up</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>22-09-2023</li>
                                    <li>11-04-2023</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">1</td>
                            <td rowspan="2">222310923</td>
                            <td rowspan="2">ALINDA EKA YUNIARTI</td>
                            <td  rowspan="2"><div class="gender-box-wrapper">
                            <div class="gender-box female">P</div></td>
                            <td rowspan="2">RPL 3</td>
                            <td rowspan="2">REKAYASA PERANGKAT LUNAK</td>
                            <td>POSITIF : 10</td>
                            <td>
                                <ul>
                                    <li>ranking 1 di kelas</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>20-08-2023</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Negatif</td>
                            <td>
                                <ul>
                                    <li>kaos kaki tidak sesuai hari</li>
                                    <li>memakai make up</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>22-09-2023</li>
                                    <li>11-04-2023</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">1</td>
                            <td rowspan="2">222310923</td>
                            <td rowspan="2">ALINDA EKA YUNIARTI</td>
                            <td rowspan="2"><div class="gender-box male">L</div></td>
                            <td rowspan="2">RPL 3</td>
                            <td rowspan="2">REKAYASA PERANGKAT LUNAK</td>
                            <td>POSITIF : 10</td>
                            <td>
                                <ul>
                                    <li>ranking 1 di kelas</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>20-08-2023</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Negatif</td>
                            <td>
                                <ul>
                                    <li>kaos kaki tidak sesuai hari</li>
                                    <li>memakai make up</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>22-09-2023</li>
                                    <li>11-04-2023</li>
                                </ul>
                            </td>
                        </tr>
                        
                        
                        <!-- Tambahkan baris lainnya di sini -->
          </tbody>
        </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>