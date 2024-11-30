<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/poin_siswa/SiswaPoin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    @extends('navbar/nav-PoinSiswa')
    <div class="button-container">
    @foreach ($jumlahNotifikasi as $index => $jumlah)
        <button class="notification-btn" onclick="window.location.href='{{ route('pesan' . ($index + 1)) }}'">
            @php
                $peringatan = match($index) {
                    0 => $poinPeringatan1->peringatan ?? 'Tidak Diketahui',
                    1 => $poinPeringatan2->peringatan ?? 'Tidak Diketahui',
                    2 => $poinPeringatan3->peringatan ?? 'Tidak Diketahui',
                    3 => $poinPeringatan4->peringatan ?? 'Tidak Diketahui',
                    4 => $poinPeringatan5->peringatan ?? 'Tidak Diketahui',
                    5 => $poinPeringatan6->peringatan ?? 'Tidak Diketahui',
                    6 => $poinPeringatan7->peringatan ?? 'Tidak Diketahui',
                    7 => $poinPeringatan8->peringatan ?? 'Tidak Diketahui',
                    default => 'Notifikasi Tidak Diketahui',
                };
            @endphp
            {{ $peringatan }}
            <span class="notification-count">{{ $jumlah }}</span>
        </button>
    @endforeach
</div>

    <div class="hero">
        <div class="judul_dan_tombol">
            <div class="judul-awal">
                <!-- Search Bar -->
                <div class="container mt-7">
                    <div class="input-group position-relative" style="border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari berdasarkan NIS, Nama, atau Kelas (Tingkatan, Jurusan, Jurusan ke)" aria-label="Search" style="border-color: #fcfc38; font-size: 12px; margin-bottom: 0;">
                        <button class="btn btn-outline-secondary" type="button" onclick="filterTable()" style=" border-width: 2px 0; border-style: solid; border-color: #fcfc38; border-radius: 0 5px 5px 0; background-color: #fcfc38; font-size: 13px; color: black; font-weight: 600;">Cari</button>
                        <span class="clear-input position-absolute" onclick="clearSearch()" style="right: 60px; top: 5px; display: none; cursor: pointer;">
                            <i class="fas fa-times" style="font-size: 18px; color: #dc3545;"></i>
                        </span>
                    </div>
                    <!-- <div class="input-group position-relative">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan NIS, Nama, atau Kelas (Tingkatan, Jurusan, Jurusan ke)" aria-label="Search">
                        <button class="btn btn-outline-secondary" onclick="filterTable()">Cari</button>
                        <span class="clear-input position-absolute" onclick="clearSearch()" style="right: 60px; top: 8px; display: none; cursor: pointer;">
                            <i class="fas fa-times" style="font-size: 18px; color: #dc3545;"></i>
                        </span>
                    </div> -->
                </div>
            </div>
            <div class="tambah_dan_hapus">
                <form action="{{ route('hapusSemuaPoinSiswa') }}" method="POST" style="display: inline; ">
                    @csrf
                    <button type="submit" class="icon-btn delete-btn"><i class="fas fa-trash"></i></button>
                </form>
                <button class="tambah" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i>Tambahkan</button>
            </div>
            
            <!-- FORMULIR TAMBAH DATA START -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        
                        <div class="modal-header" style="background-color: #e7f4ff;">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">TAMBAH POIN SISWA</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body" style="background-color: #e7f4ff;">
                            <div class="container">
                                <form action="{{ route('StoreNamaPoinSiswa') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-row">
                                        <label for="tingkatan" class="form-label">Kelas</label>
                                        
                                            <select name="tingkatan" id="tingkatan" class="form-control">
                                                <option value="" style="color: #ccc;" disabled selected>Tingkatan</option>
                                                @foreach ($tingkatanList as $tingkatan)
                                                <option value="{{ $tingkatan }}">{{ $tingkatan }}</option>
                                                @endforeach
                                            </select>
                                            <select name="jurusan" id="jurusan" class="form-control" disabled>
                                                <option value="" style="color: #ccc;" disabled selected>Jurusan</option>
                                            </select>
                                            <select name="jurusan_ke" id="jurusan_ke" class="form-control" disabled>
                                                <option value="" disabled selected>Jurusan ke</option>
                                            </select>
                                        
                                    </div>

                                    <div class="form-row">
                                        <label for="nama" class="form-label">Nama</label>
                                        <select name="nama" id="nama" class="form-control" disabled>
                                            <option value="" disabled selected>Nama siswa</option>
                                        </select>
                                    </div>

                                    <div class="form-row">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-row">
                                        <label for="tipe_poin" class="form-label">Tipe Poin</label>
                                        <div class="radio-group">
                                            <label>
                                                <input type="radio" name="tipe_poin" value="positif" onclick="toggleFotoInput()"> Positif
                                            </label>
                                            <label>
                                                <input type="radio" name="tipe_poin" value="negatif" onclick="toggleFotoInput()"> Negatif
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <label for="nama_poin" class="form-label">Nama Poin</label>
                                        <select name="nama_poin" id="nama_poin" class="form-control" disabled>
                                            <option value="" disabled selected>Nama Poin</option>
                                        </select>
                                    </div>

                                    <div class="form-row" id="foto_input_row" style="display: none;">
                                        <label for="foto" class="form-label">Unggah Foto</label>
                                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                                    </div>


                                    <div class="button-group mt-3">
                                        <button type="button" class="btn btn-dua" data-bs-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn-satu">Tambah Poin</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORMULIR TAMBAH DATA END -->
        </div>
        
        <script>
    function toggleFotoInput() {
        const tipePoinPositif = document.querySelector('input[name="tipe_poin"][value="positif"]');
        const fotoInputRow = document.getElementById('foto_input_row');
        
        // Tampilkan input foto jika tipe poin negatif dipilih, sebaliknya sembunyikan
        if (tipePoinPositif && !tipePoinPositif.checked) {
            fotoInputRow.style.display = 'block'; // Tampilkan input foto
        } else {
            fotoInputRow.style.display = 'none'; // Sembunyikan input foto
        }
    }

    // Pastikan event listener ditambahkan jika ada perubahan input pada tipe poin
    document.querySelectorAll('input[name="tipe_poin"]').forEach(input => {
        input.addEventListener('change', toggleFotoInput);
    });
</script>


        @if(session('error'))
            <div id="popupAlert" class="alert alert-danger alert-popup">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div id="popupAlert" class="alert alert-success alert-popup">
                {!! session('success') !!}
            </div>
        @endif

        <script>
            // Menutup pop-up alert secara otomatis setelah 2 detik
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    const alert = document.getElementById("popupAlert");
                    if (alert) {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500); // Hapus elemen setelah animasi selesai
                    }
                }, 10000); // 10000 ms = 10 detik
            });
        </script>
    
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
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataSiswa as $siswa)
                    <tr>
                        <td style="font-weight: 400; font-size: 11px;">{{ $loop->iteration }}</td>
                        <td style="font-weight: 400; font-size: 11px;">{{ $siswa->nis }}</td>
                        <td style="text-align: left; font-weight: 400; font-size: 11px;">{{ $siswa->nama }}</td>
                        <td style="font-weight: 400; font-size: 11px;">{{ $siswa->jenis_kelamin }}</td>
                        <td style="font-weight: 400; font-size: 11px;">{{ $siswa->tingkatan}} {{ $siswa->jurusan}} {{ $siswa->jurusan_ke}}</td>
                        <td style="font-weight: 400; font-size: 11px;">{{ $siswa->poin_negatif_akhir > 0 ? $siswa->poin_negatif_akhir : 0 }}</td>
                        <td style="font-weight: 400; font-size: 11px;">{{ $siswa->poin_positif_akhir > 0 ? $siswa->poin_positif_akhir : 0 }}</td>
                        <td>
                            <button class="add-btn" onclick="window.location.href='{{ route('viewSiswaDetail', ['nis' => $siswa->nis]) }}';">View More</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

<script>
// Fungsi untuk menghapus input pencarian dan menampilkan semua data
function clearSearch() {
    document.getElementById("searchInput").value = ""; // Kosongkan input
    document.querySelector(".clear-input").style.display = "none"; // Sembunyikan ikon clear
    showAllRows(); // Tampilkan semua data
}

// Fungsi untuk menampilkan semua data
function showAllRows() {
    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach(row => {
        row.style.display = ""; // Tampilkan semua baris
    });
}

// Event listener untuk menampilkan ikon clear hanya saat input terisi
document.getElementById("searchInput").addEventListener("input", function() {
    const clearInput = document.querySelector(".clear-input");
    clearInput.style.display = this.value ? "block" : "none"; // Tampilkan ikon clear jika input ada isinya

    // Jika input kosong, tampilkan semua data
    if (this.value === "") {
        showAllRows();
    }
});

function filterTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("table tbody tr");

    // Jika input kosong, tampilkan semua data dan keluar dari fungsi
    if (input === "") {
        showAllRows();
        return;
    }

    // Filter data jika ada teks dalam input
    rows.forEach(row => {
        const nis = row.getElementsByTagName('td')[1]?.textContent.toLowerCase() || ""; // Kolom NIS
        const nama = row.getElementsByTagName('td')[2]?.textContent.toLowerCase() || ""; // Kolom Nama
        const kelas = row.getElementsByTagName('td')[4]?.textContent.toLowerCase() || ""; // Kolom Kelas

        // Periksa apakah input pencarian ada di NIS, Nama, atau Kelas
        if (nis.includes(input) || nama.includes(input) || kelas.includes(input)) {
            row.style.display = ""; // Tampilkan baris jika cocok
        } else {
            row.style.display = "none"; // Sembunyikan baris jika tidak cocok
        }
    });
}
</script>





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $('#tingkatan').on('change', function() {
        var tingkatan = $(this).val();
        if (tingkatan) {
            $.ajax({
                url: '/get-jurusan/' + tingkatan,
                type: 'GET',
                success: function(data) {
                    console.log(data); // Debugging: lihat data yang diterima
                    
                    $('#jurusan').empty();
                    $('#jurusan').append('<option value="" disabled selected>Jurusan</option>');
                    $('#jurusan_ke').empty();
                    $('#jurusan_ke').append('<option value="" disabled selected>Jurusan ke</option>');
                    
                    // Tambahkan jurusan yang diterima dari server
                    $.each(data, function(index, jurusan) {
                        $('#jurusan').append('<option value="'+ jurusan +'">'+ jurusan +'</option>');
                    });

                    // Enable the jurusan dropdown
                    $('#jurusan').prop('disabled', false);
                    }
                });
            }
        });

        $('#jurusan').on('change', function() {
            var jurusan = $(this).val();
            if (jurusan) {
                $.ajax({
                    url: '/get-jurusan-ke/' + jurusan,
                    type: 'GET',
                    success: function(data) {
                        $('#jurusan_ke').empty();
                        $('#jurusan_ke').append('<option value="" disabled selected>Jurusan ke</option>');
                        
                        // Pastikan data yang diterima dalam format array objek
                        $.each(data, function(index, jurusanKe) {
                            $('#jurusan_ke').append('<option value="'+ jurusanKe.jurusan_ke +'">'+ jurusanKe.jurusan_ke +'</option>');
                        });
                        
                        // Enable the jurusan_ke dropdown setelah mendapatkan data
                        $('#jurusan_ke').prop('disabled', false);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching jurusan ke:', textStatus, errorThrown);
                    }
                });
            } else {
                $('#jurusan_ke').empty().prop('disabled', true);
            }
        });

        $('#jurusan_ke').on('change', function() {
            var tingkatan = $('#tingkatan').val();
            var jurusan = $('#jurusan').val();
            var jurusan_ke = $('#jurusan_ke').val();
            if (tingkatan && jurusan && jurusan_ke) {
                $.ajax({
                    url: "{{ route('SearchNamaPoinSiswa') }}", // URL untuk mendapatkan nama siswa
                    method: "GET",
                    data: {
                        tingkatan: tingkatan,
                        jurusan: jurusan,
                        jurusan_ke: jurusan_ke
                    },
                    success: function(data) {
                        $('#nama').empty();
                        $('#nama').append('<option value="" disabled selected>Nama</option>');
                        
                        // Loop through the received data and append the names to the dropdown
                        $.each(data, function(index, siswa) {
                            $('#nama').append('<option value="' + siswa.nama + '">' + siswa.nama + '</option>');
                        });
                        // Enable the name dropdown
                        $('#nama').prop('disabled', false);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching siswa names:', textStatus, errorThrown);
                    }
                });
            } else {
                $('#nama').empty().prop('disabled', true);
            }
        });

        // Function to handle tipe poin selection and load relevant points
        $('input[name="tipe_poin"]').on('change', function() {
            var tipe_poin = $(this).val();
            
            if (tipe_poin) {
                $.ajax({
                    url: '/get-nama-poin/' + tipe_poin, // URL for fetching points
                    method: 'GET',
                    success: function(data) {
                        $('#nama_poin').empty();
                        $('#nama_poin').append('<option value="" disabled selected>Nama Poin</option>');
                        
                        // Loop through data and add to the dropdown
                        $.each(data, function(index, poin) {
                            $('#nama_poin').append('<option value="' + poin.nama_poin + '">' + poin.nama_poin + '</option>');
                        });
                        
                        // Enable the points dropdown
                        $('#nama_poin').prop('disabled', false);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching poin data:', textStatus, errorThrown);
                    }
                });
            } else {
                $('#nama_poin').empty().prop('disabled', true);
            }
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>