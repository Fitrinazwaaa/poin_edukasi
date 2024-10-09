<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Daftar Kelas SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/siswa/siswa.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    @extends('navbar/nav-form')

    <!-- Search Bar -->
    <div class="container mt-3">
        <div class="input-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari siswa berdasarkan angkatan_tahun atau tingkatan" aria-label="Search" onkeyup="searchStudents()">
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
                <p class="judul1">PENGATURAN KELAS SMK N 1 KAWALI</p>
            </div>
            <div class="tambah_dan_hapus">
                <form id="deleteForm" action="{{ route('KelasHapusMultiple') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="button" class="icon-btn delete-btn" onclick="deleteSelected();"><i class="fas fa-trash-alt"></i></button>
                </form>
                <button class="tambah" onclick="window.location.href='{{ route('TambahKelas') }}';">
                    <i class="fas fa-plus"></i> Tambahkan
                </button>
            </div>
        </div>
        @foreach ($kelasByTahun as $tahun_angkatan => $Kelas)
        <div class="tabel">
            <input type="checkbox" id="dropdown{{ $tahun_angkatan }}">
            <label class="btn-toggle" for="dropdown{{ $tahun_angkatan }}">
                ANGKATAN TAHUN {{ $tahun_angkatan }}
                <span class="float-end" style="font-weight: 500; margin-right: 30px">Jumlah Kelas: {{ count($Kelas) }}</span>
            </label>
            <div class="collapse-content" id="content{{ $tahun_angkatan }}">
                <div class="card card-body">
                    <div class="table-wrapper">
                        <div class="table">
                            <table>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all{{ $tahun_angkatan }}" class="select_all"></th>
                                        <th>Tahun Angkatan</th>
                                        <th>Jurusan</th>
                                        <th>Jurusan Ke-</th>
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
    
    <script>
        function deleteSelected() {
            const checkedBoxes = document.querySelectorAll('input[name="hapus[]"]:checked');
            if (checkedBoxes.length === 0) {
                alert('Tidak ada jurusan yang dipilih untuk dihapus.');
                return;
            }

            const selectedValues = Array.from(checkedBoxes).map(cb => cb.value);
            console.log('jurusan yang dipilih untuk dihapus:', selectedValues);

            // Show modal for confirmation
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            confirmModal.show();

            // Attach event listener to the delete button inside the modal
            document.getElementById('confirmDeleteBtn').onclick = function() {
                const deleteForm = document.getElementById('deleteForm');
                checkedBoxes.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'angkatan_tahun[]'; // Ensure this matches the expected array in the controller
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
            const angkatan_tahun = row.cells[1].innerText.toLowerCase();
            const tingkatan = row.cells[2].innerText.toLowerCase();

            if (angkatan_tahun.includes(searchInput) || tingkatan.includes(searchInput)) {
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
</body>
</html>
