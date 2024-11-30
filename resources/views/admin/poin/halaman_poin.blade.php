<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin/poin/halaman_poin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    @extends('navbar/nav-Poin')
    <!-- FORMULIR TAMBAH DATA START -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #e7f4ff;">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" >TAMBAH DATA POIN NEGATIF ATAU POSITIF</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="background-color: #e7f4ff;">
                    <div class="container">
                        <form action="{{ route('submitPoin') }}" method="POST">
                        @csrf
                            <div class="container">
                                <div class="form-row">
                                    <div class="positif_negatif">
                                        <label for="tipe_poin" style="margin-right: 30px;">Tipe Poin</label>
                                        <label>
                                            <input class="positif" id="poin_positif" type="radio" name="type" value="positive"> Positif
                                        </label>
                                        <label>
                                            <input class="negatif" id="poin_negatif" type="radio" name="type" value="negative"> Negatif
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <label for="id_poin">Id Poin</label>
                                    <input type="text" name="id_poin" class="form-control" >
                                </div>
                                
                                <div class="form-row">
                                    <label for="np">Nama Pelanggaran</label>
                                    <input type="text" name="np" class="form-control" >
                                </div>

                                <div class="form-row">
                                    <label for="poin">Poin</label>
                                    <input type="text" name="poin" class="form-control" >
                                </div>

                                <div class="form-row">
                                    <label for="kategori" >Kategori</label>
                                    <select id="kategori" name="kategori" class="form-control">
                                    </select>
                                </div>

                                <div class="button-group">
                                    <button type="button" class="btn btn-dua" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn-satu" >Kirim</button>
                                </div>
                            </div>
                        </form>
                        <script>
                            document.getElementById('poin_positif').addEventListener('change', function() {
                                if (this.checked) {
                                    document.getElementById('poin_negatif').checked = false;
                                    updateKategori('positif');
                                }
                            });

                            document.getElementById('poin_negatif').addEventListener('change', function() {
                                if (this.checked) {
                                    document.getElementById('poin_positif').checked = false;
                                    updateKategori('negatif');
                                }
                            });

                            function updateKategori(tipePoin) {
                                const kategoriDropdown = document.getElementById('kategori');
                                kategoriDropdown.innerHTML = ''; // Clear existing options

                                let options = [];
                                if (tipePoin === 'positif') {
                                    options = ['A. Prestasi Lomba', 'B. Prestasi Keagamaan', 'C. Prestasi Organisasi', 'D. Perilaku Teladan'];
                                } else {
                                    options = ['A. Pakaian', 'B. Rambut', 'C. Aksesoris', 'D. Pelanggaran Berat'];
                                }


                                options.forEach(function(option) {
                                    const newOption = document.createElement('option');
                                    newOption.value = option;
                                    newOption.text = option;
                                    kategoriDropdown.appendChild(newOption);
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FORMULIR TAMBAH DATA END -->


    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data yang dipilih?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dua" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-satu" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>


    {{-- TABLE POSITIF DAN NEGATIF START--}}
    <div class="tabel">
        <div class="tipe-poin">
            <div class="tipe">
                <a href="javascript:void(0)" id="negatif-link" class="active" onclick="showTable('negatif')">Negatif</a>
                <a href="javascript:void(0)" id="positif-link" onclick="showTable('positif')">Positif</a>
            </div>
            <div class="tambah_dan_hapus" style="margin-left: -40px;"> 
                <button type="button" class="icon-btn delete-btn" id="deleteAllSelectedRecord">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <button class="tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus" style="margin-right: -4px;"></i> Tambah Poin
                </button>
            </div>
            <!-- TOMBOL TITIK TIGA -->
            <div class="dropdown" style="margin-left:10px;">
                <button class="btn btn-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu p-3 shadow-lg" aria-labelledby="dropdownMenuButton" style="width: 400px; border-radius: 8px;">
                    <li class="mb-3">
                        <div class="upload-excel">
                            <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="file" class="form-control" accept=".xls,.xlsx" style="border-top-right-radius: 0; border-bottom-right-radius: 0; margin-bottom: 0; font-size: 14px;">
                                    <button type="submit" class="btn btn-primary" style="background-color:#fcfc38; border-top-left-radius: 0; border-bottom-left-radius: 0; border: none; color: black;font-size: 14px; font-weight: 600;">Impor Excel</button>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('exportGabungan') }}">
                            <i class="fas fa-file-excel me-2 text-success"></i> Export Excel
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('exportPDF') }}">
                            <i class="fas fa-file-pdf me-2 text-danger"></i> Export PDF
                        </a>
                    </li>
                </ul>
            </div>
        </div> 


        <form id="deleteForm" action="{{ route('PoinHapusMultiple') }}" method="POST">
            @csrf
            @method('DELETE')
            <div id="negatif-table" style="display: none;">
                <div class="scroll-container">
                    <div class="table-wrapper1 scrollable-table1">
                        <table>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select_all_negatif"></th>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Kategori</th>
                                    <th>Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($poinNegatif as $poin)
                                <tr>
                                <td><input type="checkbox" name="ids_negatif[]" class="checkbox_negatif_ids" value="{{ $poin->id_poin_negatif }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                    <td>{{ $poin->nama_poin }}</td>
                                    <td>{{ $poin->kategori_poin }}</td>
                                    <td>{{ $poin->poin }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>

            <div id="positif-table" style="display: none;">
                <div class="scroll-container">
                    <div class="table-wrapper1 scrollable-table1">
                        <table>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select_all_positif"></th>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Kategori</th>
                                    <th>Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($poinPositif as $poin)
                                <tr>
                                <td><input type="checkbox" name="ids_positif[]" class="checkbox_positif_ids" value="{{ $poin->id_poin_positif }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                    <td>{{ $poin->nama_poin}}</td>
                                    <td>{{ $poin->kategori_poin}}</td>
                                    <td>{{ $poin->poin }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>

            <script>
                function showTable(type) {
                    // Sembunyikan semua tabel
                    document.getElementById('negatif-table').style.display = 'none';
                    document.getElementById('positif-table').style.display = 'none';
            
                    // Tampilkan tabel yang sesuai
                    if (type === 'negatif') {
                        document.getElementById('negatif-table').style.display = 'block';
                        document.getElementById('negatif-link').classList.add('active');
                        document.getElementById('positif-link').classList.remove('active');
                    } else if (type === 'positif') {
                        document.getElementById('positif-table').style.display = 'block';
                        document.getElementById('positif-link').classList.add('active');
                        document.getElementById('negatif-link').classList.remove('active');
                    }
                }
            
                // Iidialisasi tampilan tabel pada load
                document.addEventListener('DOMContentLoaded', function() {
                    showTable('negatif'); // Tampilkan tabel negatif secara default
                });
            </script>

            <script>
                // Memilih semua checkbox di tabel negatif
                document.getElementById('select_all_negatif').addEventListener('change', function() {
                    let checkboxes = document.querySelectorAll('.checkbox_negatif_ids');
                    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                });
            
                // Memilih semua checkbox di tabel positif
                document.getElementById('select_all_positif').addEventListener('change', function() {
                    let checkboxes = document.querySelectorAll('.checkbox_positif_ids');
                    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                });
            
                // Tampilkan modal konfirmasi sebelum hapus
                document.getElementById('deleteAllSelectedRecord').addEventListener('click', function(event) {
                    event.preventDefault();
                    
                    // Check if any checkboxes are selected
                    let selectedNegatif = document.querySelectorAll('.checkbox_negatif_ids:checked').length > 0;
                    let selectedPositif = document.querySelectorAll('.checkbox_positif_ids:checked').length > 0;
                    
                    if (selectedNegatif || selectedPositif) {
                        // Display the confirmation modal
                        let modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
                        modal.show();
                    } else {
                        alert('Silakan pilih data yang ingin dihapus.');
                    }
                });

                // Submit form upon confirmation in the modal
                document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                    document.getElementById('deleteForm').submit();
                });

            </script>
        </form>
    </div>
    <!-- TABEL POSITIF DAN NEGATIF END -->


    <!-- TABEL PERINGATAN START -->
    <div class="container">
        <div class="table-wrapper3">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peringatan</th>
                        <th>Poin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($poinPeringatan as $peringatan)
                        <tr>
                            <td>{{ $loop-> iteration }}</td>
                            <td>{{ $peringatan-> peringatan }}</td>
                            <td>>={{ $peringatan-> max_poin }}</td>
                            <td>
                                <button class="icon-btn edit-btn" onclick="window.location.href='{{ route('poinEdit', $peringatan->id_peringatan) }}';"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- TABEL PERINGATAN END -->
     <!-- JS Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>