<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Daftar Kelas SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/siswa/siswa.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .error-message {
            font-size: 13px;
            color: #ff0000; /* Merah untuk error */
            margin-top: 10px;
            white-space: pre-line; /* Agar newline ditampilkan dengan benar */
        }
    </style>
</head>
<body>
    @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show error-message" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(session('message'))
        <div id="popupAlert" class="alert alert-success alert-popup">
            {!! session('message') !!}
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
            }, 4000); // 4000 ms = 4 detik
        });
    </script>

    @extends('navbar/nav-kelas')
    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top: -20px; padding: -20px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 13px;">Anda yakin ingin menghapus kelas yang dipilih?</p>
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
                <p class="judul1"></p>
            </div>
            <div class="tambah_dan_hapus">
                <form id="deleteForm" action="{{ route('KelasHapusMultiple') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="button" class="icon-btn delete-btn" onclick="deleteSelected();"><i class="fas fa-trash-alt"></i></button>
                </form>
                <button class="tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus"></i> Tambahkan
                </button>
                <!-- Tombol Titik Tiga -->
                <div class="dropdown">
                    <button class="btn btn-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background-color:white; margin-left:-10px; ">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <!-- Menu Dropdown -->
                    <ul class="dropdown-menu p-3 shadow-lg" aria-labelledby="dropdownMenuButton" style="width: 400px; border-radius: 8px;">
                        <li class="mb-3">
                            <div class="upload-excel">
                                <form action="{{ route('KelasImport') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input type="file" name="file" class="form-control" accept=".xls,.xlsx" style="border-top-right-radius: 0; border-bottom-right-radius: 0; margin-bottom: 0; font-size: 14px;">
                                        <button type="submit" class="btn btn-primary" style="background-color:#fcfc38; border-top-left-radius: 0; border-bottom-left-radius: 0; border: none; color: black;font-size: 14px; font-weight: 600;">Impor Excel</button>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('KelasEksport') }}">
                                <i class="fas fa-file-excel me-2 text-success"></i> Eksport Excel
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <div class="modal-header" style="background-color: #e7f4ff;">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" >TAMBAH KONSENTRASI KEAHLIAN SMK N 1 KAWALI</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body" style="background-color: #e7f4ff;">
                            <div class="container">
                            <form method="POST" action="{{ route('KelasStore') }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <label for="tahun_angkatan">Tahun Angkatan</label>
                    <input type="text" name="tahun_angkatan" class="form-control" required>
                </div>

                <div class="form-row">
                    <label for="jurusan">Konsentrasi Keahlian</label>
                    <input type="text" name="jurusan" class="form-control" required>
                </div>

                <div class="form-row">
                    <label for="jurusan_ke">Jumlah Kelas</label>
                    <input type="number" name="jurusan_ke" class="form-control" required min="1">
                </div>

                <div class="button-group">
                    <button type="button" class="btn-dua" onclick="window.location.href='{{ route('kelas') }}';">Kembali</button>
                    <button type="submit" class="btn-satu">Kirim</button>
                </div>
            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        @foreach ($kelasByTahun as $tahun_angkatan => $Kelas)
        <div class="tabel">
            <input type="checkbox" id="dropdown{{ $tahun_angkatan }}">
            <label class="btn-toggle" for="dropdown{{ $tahun_angkatan }}">
                Angkatan Tahun {{ $tahun_angkatan }}
                <span class="float-end" style="font-weight: 500; margin-right: 20px; font-size: 11px;">Jumlah Kelas: {{ count($Kelas) }}</span>
            </label>
            <div class="collapse-content" id="content{{ $tahun_angkatan }}">
                <div class="card card-body" style="border: none;">
                    <div class="table-wrapper">
                        <div class="table">
                            <table>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all{{ $tahun_angkatan }}" class="select_all"></th>
                                        <th>Tahun Angkatan</th>
                                        <th>Konsentrasi Keahlian</th>
                                        <th>Konsentrasi Keahlian Ke-</th>
                                    </tr>
                                </thead>
                                <tbody id="studentTable{{ $tahun_angkatan }}">
                                    @foreach ($Kelas as $item)
                                    <tr>
                                        <td><input type="checkbox" name="hapus[]" class="checkbox_ids{{ $tahun_angkatan }}" value="{{ $item->id }}"></td>
                                        <td>{{ $item->tahun_angkatan }}</td>
                                        <td>{{ $item->jurusan }}</td>
                                        <td>{{ $item->jurusan_ke }}</td>
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
            alert('Tidak ada kelas yang dipilih untuk dihapus.');
            return;
        }

        const selectedValues = Array.from(checkedBoxes).map(cb => cb.value);
        console.log('Kelas yang dipilih untuk dihapus:', selectedValues);

        // Tampilkan modal konfirmasi
        const confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        confirmModal.show();

        // Lampirkan event listener untuk tombol hapus di modal
        document.getElementById('confirmDeleteBtn').onclick = function() {
            const deleteForm = document.getElementById('deleteForm');
            checkedBoxes.forEach(cb => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'hapus[]'; // Pastikan sesuai dengan input checkbox yang ingin dihapus
                input.value = cb.value;
                deleteForm.appendChild(input);
            });
            deleteForm.submit(); // Kirim form
        };
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
