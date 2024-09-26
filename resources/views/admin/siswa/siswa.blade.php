
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
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
        @foreach ($siswaByTahun as $tahun_angkatan => $siswa)
        <div class="tabel">
            <input type="checkbox" id="dropdown{{ $tahun_angkatan }}">
            <label class="btn-toggle" for="dropdown{{ $tahun_angkatan }}">
                ANGKATAN TAHUN {{ $tahun_angkatan }}
            </label>
            <div class="collapse-content" id="content{{ $tahun_angkatan }}">
                <div class="card card-body">
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis<br>Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Angkatan (Tahun)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $item)
                                <tr>
                                    <td><input type="checkbox" name="hapus[]" value="{{ $item->nis }}"></td>
                                    <td>{{ $item->nis }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->tahun_angkatan }}</td>
                                    <td>
                                        <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('SiswaEdit', $item['nis']) }}';">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach        
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