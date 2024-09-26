
<!DOCTYPE html>
<html lang="en">
<head>
    <meta chars style="display: flex; justify-content: center; align-items: center;"et="UTF-8">
    <meta name="view Moreport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/siswa/siswa.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    @extends('navbar/nav-utama')
    <div class="hero">
        <div class="judul_dan_tombol">
            <div class="judul-awal">
                <p class="judul1">TABEL SISWA SMK N 1 KAWALI</p>
                <p class="judul2">PERIODE 2022-2024</p>
            </div>
            <div class="tambah_dan_hapus">
                <button class="icon-btn delete-btn"><i class="fas fa-trash-alt"></i></button>
                <button class="tambah" onclick="window.location.href='{{ route('TambahSiswa') }}';">
                    <i class="fas fa-plus"></i> Tambahkan
                </button>
            </div>
        </div>

        <!-- Dropdown with CSS only -->
        <div class="tabel">
            <input type="checkbox" id="dropdown1">
            <label class="btn-toggle" for="dropdown1">
                ANGKATAN TAHUN 2023 - 2024
            </label>
            <div class="collapse-content" id="content1" >
                <div class="card card-body">
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis<br>Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Angkatan (Tahun)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="hapus[]" id="hapus" value="222310372">
                                    </td>
                                    <td>1</td>
                                    <td>222310372</td>
                                    <td class="align-left">nama perempuan 1</td>
                                    <td>
                                        <div class="gender-box female">P</div>
                                    </td>
                                    <td class="align-left">10 Rekayasa Perangkat Lunak 3</td>
                                    <td>2023-2024</td>
                                    <td>
                                        <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('EditSiswa') }}';"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                    <td>
                                        <input type="checkbox" name="hapus[]" id="hapus" value="222310372">
                                    </td>
                                    <td>2</td>
                                    <td>222310371</td>
                                    <td class="align-left">nama laki laki 1</td>
                                    <td>
                                        <div class="gender-box male">L</div>
                                    </td>
                                    <td class="align-left">10 Gim 1</td>
                                    <td>2023-2024</td>
                                    <td>
                                        <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('EditSiswa') }}';"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="hapus[]" id="hapus" value="222310372">
                                    </td>
                                    <td>3</td>
                                    <td>222310370</td>
                                    <td class="align-left">nama perempuan 2</td>
                                    <td>
                                        <div class="gender-box female">P</div>
                                    </td>
                                    <td class="align-left">10 Teknik Komputer Jaringan 3</td>
                                    <td>2023-2024</td>
                                    <td>
                                        <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('EditSiswa') }}';"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                    <td>
                                        <input type="checkbox" name="hapus[]" id="hapus" value="222310372">
                                    </td>
                                    <td>4</td>
                                    <td>222310369</td>
                                    <td class="align-left">nama laki laki 2</td>
                                    <td>
                                        <div class="gender-box male">L</div>
                                    </td>
                                    <td class="align-left">10 Seni Karawitan 1</td>
                                    <td>2023-2024</td>
                                    <td>
                                        <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('EditSiswa') }}';"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabel">
            <input type="checkbox" id="dropdown2">
            <label class="btn-toggle" for="dropdown2">
                ANGKATAN TAHUN 2022 - 2023
            </label>
            <div class="collapse-content" id="content2">
                <div class="card card-body">
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis<br>Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Angkatan (Tahun)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="hapus[]" id="hapus" value="222310372">
                                    </td>
                                    <td>1</td>
                                    <td>222310382</td>
                                    <td class="align-left">nama perempuan</td>
                                    <td>
                                        <div class="gender-box female">P</div>
                                    </td>
                                    <td class="align-left">11 Desain Permodelan Informasi Bangunan 2</td>
                                    <td>2022-2023</td>
                                    <td>
                                        <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('EditSiswa') }}';"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="hapus[]" id="hapus" value="222310372">
                                    </td>
                                    <td>2</td>
                                    <td>222310381</td>
                                    <td class="align-left">nama laki laki</td>
                                    <td>
                                        <div class="gender-box male">L</div>
                                    </td>
                                    <td class="align-left">11 Teknik Kendaraan Ringan Otomotif 3</td>
                                    <td>2022-2023</td>
                                    <td>
                                        <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('EditSiswa') }}';"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabel">
            <input type="checkbox" id="dropdown3">
            <label class="btn-toggle" for="dropdown3">
                ANGKATAN TAHUN 2021 - 2022
            </label>
            <div class="collapse-content" id="content3">
                <div class="card card-body">
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis<br>Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Angkatan (Tahun)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="hapus[]" id="hapus" value="222310372">
                                    </td>
                                    <td>1</td>
                                    <td>222310392</td>
                                    <td class="align-left">nama perempuan</td>
                                    <td>
                                        <div class="gender-box female">P</div>
                                    </td>
                                    <td class="align-left">12 Akuntansi 3</td>
                                    <td>2021-2022</td>
                                    <td>
                                        <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('EditSiswa') }}';"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="hapus[]" id="hapus" value="222310372">
                                    </td>
                                    <td>2</td>
                                    <td>222310391</td>
                                    <td class="align-left">nama laki laki</td>
                                    <td>
                                        <div class="gender-box male">L</div>
                                    </td>
                                    <td class="align-left">12 Menejemen Perkantoran 3</td>
                                    <td>2021-2022</td>
                                    <td>
                                        <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('EditSiswa') }}';"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteSelected() {
            const checkedBoxes = document.querySelectorAll('input[name="hapus[]"]:checked');
            if (checkedBoxes.length === 0) {
                alert('Tidak ada siswa yang dipilih untuk dihapus.');
                return;
            }

            const selectedValues = Array.from(checkedBoxes).map(cb => cb.value);
            console.log('Siswa yang dipilih untuk dihapus:', selectedValues);

            // Kirim data untuk dihapus atau lakukan aksi lain
        }

        6
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    const content = this.nextElementSibling;
                    setTimeout(function() {
                        content.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 300);  // Delay untuk menunggu animasi dropdown selesai
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>