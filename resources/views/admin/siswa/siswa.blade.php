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
    @extends('navbar/nav-form')

    <!-- Search Bar -->
    <div class="container mt-3">
        <div class="input-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari siswa berdasarkan NIS atau Nama" aria-label="Search" onkeyup="searchStudents()">
            <button class="btn btn-outline-secondary" type="button" onclick="searchStudents()">Cari</button>
        </div>
    </div>

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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="hero">
        <div class="judul_dan_tombol">
            <div class="judul-awal">
                <p class="judul1">TABEL SISWA SMK N 1 KAWALI</p>
                <p class="judul2">PERIODE 2022-2024</p>
            </div>
            <div class="tambah_dan_hapus">
                <form id="deleteForm" action="{{ route('SiswaHapusMultiple') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="button" class="icon-btn delete-btn" onclick="deleteSelected();"><i class="fas fa-trash-alt"></i></button>
                </form>
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
                <span class="float-end" style="font-weight: 500; margin-right: 30px">Jumlah Siswa: {{ count($siswa) }}</span>
            </label>
            <div class="collapse-content" id="content{{ $tahun_angkatan }}">
                <div class="card card-body">
                    <div class="table-wrapper">
                        <div class="table">
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
                                <tbody id="studentTable{{ $tahun_angkatan }}">
                                    @foreach ($siswa as $item)
                                    <tr>
                                        <td><input type="checkbox" name="hapus[]" value="{{ $item->nis }}"></td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->tahun_angkatan }}</td>
                                        <td>
                                            <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('SiswaEdit', $item->nis) }}';">
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
    
    <script>
        function deleteSelected() {
            const checkedBoxes = document.querySelectorAll('input[name="hapus[]"]:checked');
            if (checkedBoxes.length === 0) {
                alert('Tidak ada siswa yang dipilih untuk dihapus.');
                return;
            }

            const selectedValues = Array.from(checkedBoxes).map(cb => cb.value);
            console.log('Siswa yang dipilih untuk dihapus:', selectedValues);

            // Show modal for confirmation
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            confirmModal.show();

            // Attach event listener to the delete button inside the modal
            document.getElementById('confirmDeleteBtn').onclick = function() {
                const deleteForm = document.getElementById('deleteForm');
                checkedBoxes.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'nis[]'; // Ensure this matches the expected array in the controller
                    input.value = cb.value;
                    deleteForm.appendChild(input);
                });
                deleteForm.submit();
            };
        }

        function searchStudents() {
    console.log("Tombol search dipanggil");
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const tables = document.querySelectorAll('.table');

    tables.forEach(table => {
        const rows = table.querySelectorAll('tbody tr');
        let foundVisible = false; // Track if any rows are visible

        rows.forEach(row => {
            const nis = row.cells[1].innerText.toLowerCase();
            const nama = row.cells[2].innerText.toLowerCase();

            if (nis.includes(searchInput) || nama.includes(searchInput)) {
                row.style.display = ''; // Show row
                foundVisible = true; // At least one row is visible
            } else {
                row.style.display = 'none'; // Hide row
            }
        });

        // Show or hide the entire table based on whether any rows are visible
        if (foundVisible) {
            table.style.display = ''; // Show the table
        } else {
            table.style.display = 'none'; // Hide the table
        }
    });

    // Check if any tables are visible
    const anyTableVisible = Array.from(tables).some(table => table.style.display !== 'none');
    // Show all tables if at least one match was found
    if (anyTableVisible) {
        tables.forEach(table => table.style.display = ''); // Show all tables
    } else {
        tables.forEach(table => table.style.display = 'none'); // Hide all tables
    }
}

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
