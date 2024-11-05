<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Daftar Siswa SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/siswa/siswa.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    @extends('navbar/nav-siswa')
    @if(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
            <form action="{{ route('siswa.replace', session('replace')['nis']) }}" method="POST">
                @csrf
                <input type="hidden" name="nama" value="{{ session('replace')['nama'] }}">
                <input type="hidden" name="tingkatan" value="{{ old('tingkatan') }}">
                <input type="hidden" name="jurusan" value="{{ old('jurusan') }}">
                <input type="hidden" name="jurusan_ke" value="{{ old('jurusan_ke') }}">
                <input type="hidden" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                <input type="hidden" name="tahun_angkatan" value="{{ old('tahun_angkatan') }}">
                
                <button type="submit" class="btn btn-danger">Ganti Data</button>
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Batal</button>
            </form>
        </div>
    @endif

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top: -20px; padding: -20px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 13px;">Anda yakin ingin menghapus siswa yang dipilih?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dua" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-satu" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="hero">
        <div class="judul_dan_tombol">
            <div class="judul-awal">
                <!-- Search Bar -->
                <div class="container mt-7">
                    <div class="input-group position-relative">
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari siswa berdasarkan NIS atau Nama" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="button" onclick="searchStudents()">Cari</button>
                        <span class="clear-input position-absolute" onclick="clearSearch()" style="right: 60px; top: 8px; display: none; cursor: pointer;">
                            <i class="fas fa-times" style="font-size: 18px; color: #dc3545;"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="tambah_dan_hapus">
                <form id="deleteForm" action="{{ route('SiswaHapusMultiple') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="button" class="icon-btn delete-btn" onclick="deleteSelected();"><i class="fas fa-trash-alt"></i></button>
                </form>
                <button class="tambah" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus"></i> Tambahkan
                </button>
            </div>

            <!-- Tombol Titik Tiga -->
            <div class="dropdown">
                <button class="btn btn-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <!-- Menu Dropdown -->
                <ul class="dropdown-menu p-3 shadow-lg" aria-labelledby="dropdownMenuButton" style="width: 400px; border-radius: 8px;">
                    <li class="mb-3">
                        <div class="upload-excel">
                            <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="file" class="form-control" accept=".xls,.xlsx" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                    <button type="submit" class="btn btn-primary" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Impor Excel</button>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('SiswaExport') }}">
                            <i class="fas fa-file-excel me-2 text-success"></i> Export Excel
                        </a>
                    </li>
                    <li>
                        <div class="container mb-4">
                            <button class="btn btn-primary" onclick="increaseTingkatan()">Tambah Tingkatan Semua Siswa</button>
                        </div>

                        <script>
                            function increaseTingkatan() {
                                if (confirm("Apakah Anda yakin ingin menambah tingkatan untuk semua siswa?")) {
                                    // Redirect ke route untuk menambah tingkatan
                                    window.location.href = "{{ route('increaseTingkatan') }}";
                                }
                            }
                        </script>
                    </li>
                </ul>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <div class="modal-header" style="background-color: #e7f4ff;">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" >TAMBAH DATA SISWA</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body" style="background-color: #e7f4ff;">
                            <div class="container">
                                <form method="POST" action="{{ route('SiswaStore') }}">
                                    @csrf
                                    @method('PUT')
                                    <br>
                                    <div class="form-row">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control">
                                    </div>

                                    <div class="form-row">
                                        <label for="nis">Nis</label>
                                        <input type="text" name="nis" class="form-control">
                                    </div>

                                    <div class="form-row">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="laki-laki">Laki-Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-row">
                                        <label for="tahun_angkatan">Tahun Angkatan</label>
                                        <select name="tahun_angkatan" id="tahun_angkatan" class="form-control">
                                            <option value="" disabled selected>Pilih Tahun Angkatan</option>
                                            @foreach($tahun_angkatan as $tahun)
                                                <option value="{{ $tahun->tahun_angkatan }}">{{ $tahun->tahun_angkatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-row">
                                        <label for="kelas">Kelas</label>

                                        <select name="tingkatan" class="form-control" style="margin-right:30px;">
                                            <option value="" style="color: #ccc;" disabled selected>Tingkatan</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                        </select>

                                        <select name="jurusan" id="jurusan" class="form-control" style="margin-right:30px;">
                                            <option value="" style="color: #ccc;" disabled selected>Jurusan</option>
                                        </select>

                                        <select name="jurusan_ke" id="jurusan_ke" class="form-control">
                                            <option value="" style="color: #ccc;" disabled selected>Jurusan ke</option>
                                        </select>
                                    </div>

                                    <div class="modal-footer" style="background-color: #e7f4ff;">
                                        <button type="button" class="btn btn-dua" data-bs-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-satu">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@php
    // Convert collection to an array and sort it in descending order by keys (tahun_angkatan)
    $sortedSiswaByTahun = $siswaByTahun->toArray();
    krsort($sortedSiswaByTahun);
@endphp

@foreach ($sortedSiswaByTahun as $tahun_angkatan => $siswa)
    <div class="tabel" data-tahun-angkatan="{{ $tahun_angkatan }}">
        <input type="checkbox" id="dropdown{{ $tahun_angkatan }}">
        <label class="btn-toggle" for="dropdown{{ $tahun_angkatan }}">
            ANGKATAN TAHUN {{ $tahun_angkatan }}
            <span class="float-end" style="font-weight: 500; margin-right: 30px">Jumlah Siswa: {{ count($siswa) }}</span>
        </label>
        <div class="collapse-content" id="content{{ $tahun_angkatan }}">
            <div class="card card-body">
                <div class="table-wrapper">
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select_all{{ $tahun_angkatan }}" class="select_all"></th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis<br>Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Angkatan (Tahun)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="studentTable{{ $tahun_angkatan }}">
                                @foreach ($siswa as $item)
                                <tr data-nis="{{ $item['nis'] }}" data-nama="{{ $item['nama'] }}">
                                    <td><input type="checkbox" name="hapus[]" class="checkbox_ids{{ $tahun_angkatan }}" value="{{ $item['nis'] }}"></td>
                                    <td>{{ $item['nis'] }}</td>
                                    <td style="text-align: left;">{{ $item['nama'] }}</td>
                                    <td>{{ $item['jenis_kelamin'] }}</td>
                                    <td>{{ $item['tingkatan'] }} {{ $item['jurusan'] }} {{ $item['jurusan_ke'] }}</td>
                                    <td>{{ $item['tahun_angkatan'] }}</td>
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
    </div>
@endforeach
</div>

<script type="text/javascript">
document.querySelectorAll('.btn-toggle').forEach((button, index) => {
    // Skip the first button (index === 0) and apply to the rest
    if (index > 0) {
        button.addEventListener('click', function() {
            var targetId = this.getAttribute('for');
            var targetContent = document.getElementById('content' + targetId.replace('dropdown', ''));
            
            if (targetContent && !targetContent.classList.contains('show')) {
                setTimeout(function() {
                    targetContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 400);
            }
        });
    }
});
</script>



    
<script>
// Fungsi untuk memilih semua checkbox di tabel sesuai dengan angkatan
document.querySelectorAll('.select_all').forEach(function(selectAllCheckbox) {
    selectAllCheckbox.addEventListener('change', function() {
        // Ambil angkatan berdasarkan id checkbox "Select All"
        const tahunAngkatan = this.id.replace('select_all', '');
        
        // Cari semua checkbox kelas di tabel yang relevan
        let checkboxes = document.querySelectorAll(`.checkbox_ids${tahunAngkatan}`);
        
        // Ubah status checkbox sesuai dengan checkbox "Select All"
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
});

function deleteSelected() {
    const checkedBoxes = document.querySelectorAll('input[name="hapus[]"]:checked');
    if (checkedBoxes.length === 0) {
        alert('Tidak ada Siswa yang dipilih untuk dihapus.');
        return;
    }

    const selectedValues = Array.from(checkedBoxes).map(cb => cb.value);
    console.log('Siswa yang dipilih untuk dihapus:', selectedValues);

    // Tampilkan modal konfirmasi
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    confirmModal.show();

    // Lampirkan event listener untuk tombol hapus di modal
    document.getElementById('confirmDeleteBtn').onclick = function() {
        const deleteForm = document.getElementById('deleteForm');
        selectedValues.forEach(value => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'hapus[]'; // Pastikan sesuai dengan input checkbox yang ingin dihapus
            input.value = value;
            deleteForm.appendChild(input);
        });
        deleteForm.submit(); // Kirim form
    };
}

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

   <script type="text/javascript">
        $('#tahun_angkatan').on('change', function() {
            var tahunAngkatan = $(this).val();
            
            if (tahunAngkatan) {
                $.ajax({
                    url: '/get-jurusan-datasiswa/' + tahunAngkatan,  // Sesuaikan dengan fungsi baru
                    type: 'GET',
                    success: function(data) {
                        $('#jurusan').empty();
                        $('#jurusan').append('<option value="" disabled selected>Pilih Jurusan</option>');
                        $('#jurusan_ke').empty();
                        $('#jurusan_ke').append('<option value="" disabled selected>Pilih Jurusan ke</option>');

                        var jurusanSet = new Set();
                        $.each(data, function(index, jurusan) {
                            if (!jurusanSet.has(jurusan.jurusan)) {
                                $('#jurusan').append('<option value="'+ jurusan.jurusan +'">'+ jurusan.jurusan +'</option>');
                                jurusanSet.add(jurusan.jurusan);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + error);
                    }
                });
            }
        });

        $('#jurusan').on('change', function() {
    var jurusan = $(this).val();
    var tahunAngkatan = $('#tahun_angkatan').val(); // Ambil tahun angkatan yang dipilih

    if (jurusan && tahunAngkatan) {
        $.ajax({
            url: '/get-jurusan-ke-datasiswa/' + tahunAngkatan + '/' + jurusan, // URL diubah untuk mencocokkan tahun angkatan dan jurusan
            type: 'GET',
            success: function(data) {
                $('#jurusan_ke').empty();
                $('#jurusan_ke').append('<option value="" disabled selected>Pilih Jurusan ke</option>');

                $.each(data, function(index, jurusanKe) {
                    $('#jurusan_ke').append('<option value="'+ jurusanKe.jurusan_ke +'">'+ jurusanKe.jurusan_ke +'</option>');
                });

                $('#jurusan_ke').prop('disabled', false); // Aktifkan dropdown 'jurusan ke'
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    }
});
   </script>
   <!-- Script Pencarian -->
   <script>
// Fungsi untuk menghapus input pencarian
function clearSearch() {
    document.getElementById("searchInput").value = ""; // Hapus nilai input
    document.querySelector(".clear-input").style.display = "none"; // Sembunyikan ikon
    searchStudents(); // Panggil fungsi pencarian untuk menyembunyikan semua siswa
}

// Pastikan fungsi ini diatur di luar fungsi lain
document.getElementById("searchInput").addEventListener("input", function() {
    const clearInput = document.querySelector(".clear-input");
    clearInput.style.display = this.value ? "block" : "none"; // Sembunyikan atau tampilkan ikon
});


    function searchStudents() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const tables = document.querySelectorAll(".tabel");

        let found = false;
        tables.forEach(table => {
            const tahunAngkatan = table.getAttribute("data-tahun-angkatan");
            const rows = table.querySelectorAll(`#studentTable${tahunAngkatan} tr`);

            let matchFound = false;
            rows.forEach(row => {
                const nis = row.getAttribute("data-nis").toLowerCase();
                const nama = row.getAttribute("data-nama").toLowerCase();

                if (nis.includes(searchInput) || nama.includes(searchInput)) {
                    row.style.display = "";
                    matchFound = true;
                    found = true;
                } else {
                    row.style.display = "none";
                }
            });

            // Jika ada kecocokan di tabel ini, aktifkan dropdown dan buka isi tabel
            const collapseContent = document.getElementById(`content${tahunAngkatan}`);
            if (matchFound) {
                collapseContent.classList.add("show"); // Tampilkan isi tabel
                document.getElementById(`dropdown${tahunAngkatan}`).checked = true; // Otomatis aktifkan dropdown
            } else {
                collapseContent.classList.remove("show"); // Sembunyikan isi tabel jika tidak ada kecocokan
                document.getElementById(`dropdown${tahunAngkatan}`).checked = false; // Nonaktifkan dropdown
            }
        });

        if (!found) {
            alert("Data tidak ditemukan.");
        }
    }
</script>
</body>
</html>
