<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/poin_siswa/SiswaPoin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"></head>
<body>
    @extends('navbar/nav-form')
        <div class="judul-awal">
            <p class="judul1">TABEL PEROLEHAN POIN NEGATIF & POIN POSITIF SISWA SMKN 1 KAWALI</p>
            <p class="judul2">PERIODE 2022-2024</p>
        <div>
    <div class="button-container">
            @foreach ($jumlahNotifikasi as $index => $jumlah)
                <button class="notification-btn" onclick="window.location.href='{{ route('pesan' . ($index + 1)) }}'">
                    @switch($index)
                        @case(0)
                            Teguran Lisan
                            @break
                        @case(1)
                            Peringatan Tertulis
                            @break
                        @case(2)
                            Peringatan Tertulis Orang Tua
                            @break
                        @case(3)
                            Pemanggilan Orang Tua
                            @break
                        @case(4)
                            Surat Perjanjian Bermaterai
                            @break
                        @case(5)
                            Siswa Skors 3 Hari
                            @break
                        @case(6)
                            Siswa Skors 6 Hari
                            @break
                        @case(7)
                            Rekomendasi Kesiswaan
                            @break
                        @default
                            Notifikasi Tidak Diketahui
                    @endswitch
                    <span class="notification-count">{{ $jumlah }}</span>
                </button>
            @endforeach
        </div>

        <div class="tambah_dan_hapus">
            <form action="{{ route('hapusSemuaPoinSiswa') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="icon-btn delete-btn"><i class="fas fa-trash"></i> Hapus Semua</button>
            </form>
            <button class="tambah" onclick="window.location.href='{{ route('TambahNamaPoinSiswa') }}';"><i class="fas fa-plus"></i>Tambahkan</button>
        </div>
        
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIS</th>
                        <th>NAMA</th>
                        <th>JENIS <br> KELAMIN</th>
                        <th>KELAS</th>
                        <th>NEGATIF</th>
                        <th>POSITIF</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataSiswa as $siswa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $siswa->nis }}</td>
                        <td style="text-align: left;">{{ $siswa->nama }}</td>
                        <td>{{ $siswa->jenis_kelamin }}</td>
                        <td>{{ $siswa->tingkatan}} {{ $siswa->jurusan}} {{ $siswa->jurusan_ke}}</td>
                        <td>{{ $siswa->poin_negatif_akhir > 0 ? $siswa->poin_negatif_akhir : 0 }}</td>
                        <td>{{ $siswa->poin_positif_akhir > 0 ? $siswa->poin_positif_akhir : 0 }}</td>
                        <td>
                            <button class="add-btn" onclick="window.location.href='{{ route('viewSiswaDetail', ['nis' => $siswa->nis]) }}';">View More</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>