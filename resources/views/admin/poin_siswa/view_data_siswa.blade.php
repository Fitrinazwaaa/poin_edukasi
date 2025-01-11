<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Header dan Tabel Poin Siswa</title>
    <link rel="stylesheet" href="{{ asset('css/admin/poin_siswa/view_data_siswa.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #e7f4ff;">
    @extends('navbar/nav-ViewSiswa')
    @if (Auth::user()->role == 'user_edit') 
        <!-- Cek apakah data siswa ada -->
        @if($siswa)
            <div class="container">
                <!-- Poin Positif -->
                <div class="table-section" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="judul">
                        <h3>POIN POSITIF</h3>
                    </div>
                    <div class="hapus">
                        <button class="delete-icon" id="deletePositif"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    <div class="table-wrapper">
                        <table class="table" id="tablePositif">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllPositif"></th>
                                    <th>NO</th>
                                    <th>WAKTU</th>
                                    <th>KETERANGAN</th>
                                    <th>POIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($poinPositif->isNotEmpty())
                                    @foreach($poinPositif as $positif)
                                        <tr>
                                            <td><input type="checkbox" class="selectPositif" value="{{ $positif->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $positif->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $positif->nama_poin_positif }}</td>
                                            <td>{{ $positif->poin_positif }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Tidak ada poin positif</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Poin Negatif -->
                <div class="table-section" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="judul">
                        <h3>POIN NEGATIF</h3>
                    </div>
                    <div class="hapus">
                        <button class="delete-icon" id="deleteNegatif"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    <div class="table-wrapper">
                        <table class="table" id="tableNegatif">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllNegatif"></th>
                                    <th>NO</th>
                                    <th>WAKTU</th>
                                    <th>KETERANGAN</th>
                                    <th>POIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($poinNegatif->isNotEmpty())
                                    @foreach($poinNegatif as $negatif)
                                        <tr>
                                            <td><input type="checkbox" class="selectNegatif" value="{{ $negatif->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $negatif->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $negatif->nama_poin_negatif }}</td>
                                            <td>{{ $negatif->poin_negatif }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Tidak ada poin negatif</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <!-- Pesan jika data siswa tidak ditemukan -->
            <p>Data siswa tidak ditemukan</p>
            <script>
                // Redirect ke halaman PoinSiswa jika data kosong
                window.location.href = "{{ route('PoinSiswa') }}";
            </script>
        @endif

        <script>
            // Fungsi Kembali ke halaman PoinSiswa dengan refresh
            function goBack() {
                window.location.href = "{{ route('PoinSiswa') }}";
            }

            // Select All Checkbox for Positif
            $('#selectAllPositif').click(function() {
                $('.selectPositif').prop('checked', this.checked);
            });

            // Select All Checkbox for Negatif
            $('#selectAllNegatif').click(function() {
                $('.selectNegatif').prop('checked', this.checked);
            });

            // Delete Selected Rows for Poin Positif
            $('#deletePositif').click(function() {
                var selected = [];
                $('.selectPositif:checked').each(function() {
                    selected.push($(this).val());
                });
                if (selected.length > 0) {
                    $.ajax({
                        url: "{{ route('deletePoinPositif') }}",
                        method: 'POST',
                        data: {
                            ids: selected,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                } else {
                    alert('Pilih poin positif yang ingin dihapus');
                }
            });

            // Delete Selected Rows for Poin Negatif
            $('#deleteNegatif').click(function() {
                var selected = [];
                $('.selectNegatif:checked').each(function() {
                    selected.push($(this).val());
                });
                if (selected.length > 0) {
                    $.ajax({
                        url: "{{ route('deletePoinNegatif') }}",
                        method: 'POST',
                        data: {
                            ids: selected,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                } else {
                    alert('Pilih poin negatif yang ingin dihapus');
                }
            });
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @elseif (Auth::user()->role == 'user4') 
        <!-- Cek apakah data siswa ada -->
        @if($siswa)
            <div class="container">
                <!-- Poin Positif -->
                <div class="table-section" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="judul">
                        <h3>POIN POSITIF</h3>
                    </div>
                    <div class="table-wrapper">
                        <table class="table" id="tablePositif">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllPositif"></th>
                                    <th>NO</th>
                                    <th>WAKTU</th>
                                    <th>KETERANGAN</th>
                                    <th>POIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($poinPositif->isNotEmpty())
                                    @foreach($poinPositif as $positif)
                                        <tr>
                                            <td><input type="checkbox" class="selectPositif" value="{{ $positif->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $positif->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $positif->nama_poin_positif }}</td>
                                            <td>{{ $positif->poin_positif }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Tidak ada poin positif</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Poin Negatif -->
                <div class="table-section" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="judul">
                        <h3>POIN NEGATIF</h3>
                    </div>
                    <div class="table-wrapper">
                        <table class="table" id="tableNegatif">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllNegatif"></th>
                                    <th>NO</th>
                                    <th>WAKTU</th>
                                    <th>KETERANGAN</th>
                                    <th>POIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($poinNegatif->isNotEmpty())
                                    @foreach($poinNegatif as $negatif)
                                        <tr>
                                            <td><input type="checkbox" class="selectNegatif" value="{{ $negatif->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $negatif->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $negatif->nama_poin_negatif }}</td>
                                            <td>{{ $negatif->poin_negatif }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Tidak ada poin negatif</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <!-- Pesan jika data siswa tidak ditemukan -->
            <p>Data siswa tidak ditemukan</p>
            <script>
                // Redirect ke halaman PoinSiswa jika data kosong
                window.location.href = "{{ route('PoinSiswa') }}";
            </script>
        @endif

        <script>
            // Fungsi Kembali ke halaman PoinSiswa dengan refresh
            function goBack() {
                window.location.href = "{{ route('PoinSiswa') }}";
            }

            // Select All Checkbox for Positif
            $('#selectAllPositif').click(function() {
                $('.selectPositif').prop('checked', this.checked);
            });

            // Select All Checkbox for Negatif
            $('#selectAllNegatif').click(function() {
                $('.selectNegatif').prop('checked', this.checked);
            });

            // Delete Selected Rows for Poin Positif
            $('#deletePositif').click(function() {
                var selected = [];
                $('.selectPositif:checked').each(function() {
                    selected.push($(this).val());
                });
                if (selected.length > 0) {
                    $.ajax({
                        url: "{{ route('deletePoinPositif') }}",
                        method: 'POST',
                        data: {
                            ids: selected,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                } else {
                    alert('Pilih poin positif yang ingin dihapus');
                }
            });

            // Delete Selected Rows for Poin Negatif
            $('#deleteNegatif').click(function() {
                var selected = [];
                $('.selectNegatif:checked').each(function() {
                    selected.push($(this).val());
                });
                if (selected.length > 0) {
                    $.ajax({
                        url: "{{ route('deletePoinNegatif') }}",
                        method: 'POST',
                        data: {
                            ids: selected,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                } else {
                    alert('Pilih poin negatif yang ingin dihapus');
                }
            });
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
    @elseif (Auth::user()->role == 'admin') 
        <!-- Cek apakah data siswa ada -->
        @if($siswa)
            <div class="container">
                <!-- Poin Positif -->
                <div class="table-section" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="judul">
                        <h3>POIN POSITIF</h3>
                    </div>
                    <div class="hapus">
                        <button class="delete-icon" id="deletePositif"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    <div class="table-wrapper">
                        <table class="table" id="tablePositif">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllPositif"></th>
                                    <th>NO</th>
                                    <th>WAKTU</th>
                                    <th>KETERANGAN</th>
                                    <th>POIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($poinPositif->isNotEmpty())
                                    @foreach($poinPositif as $positif)
                                        <tr>
                                            <td><input type="checkbox" class="selectPositif" value="{{ $positif->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $positif->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $positif->nama_poin_positif }}</td>
                                            <td>{{ $positif->poin_positif }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Tidak ada poin positif</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Poin Negatif -->
                <div class="table-section" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="judul">
                        <h3>POIN NEGATIF</h3>
                    </div>
                    <div class="hapus">
                        <button class="delete-icon" id="deleteNegatif"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    <div class="table-wrapper">
                        <table class="table" id="tableNegatif">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllNegatif"></th>
                                    <th>NO</th>
                                    <th>WAKTU</th>
                                    <th>KETERANGAN</th>
                                    <th>POIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($poinNegatif->isNotEmpty())
                                    @foreach($poinNegatif as $negatif)
                                        <tr>
                                            <td><input type="checkbox" class="selectNegatif" value="{{ $negatif->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $negatif->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $negatif->nama_poin_negatif }}</td>
                                            <td>{{ $negatif->poin_negatif }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Tidak ada poin negatif</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <!-- Pesan jika data siswa tidak ditemukan -->
            <p>Data siswa tidak ditemukan</p>
            <script>
                // Redirect ke halaman PoinSiswa jika data kosong
                window.location.href = "{{ route('PoinSiswa') }}";
            </script>
        @endif

        <script>
            // Fungsi Kembali ke halaman PoinSiswa dengan refresh
            function goBack() {
                window.location.href = "{{ route('PoinSiswa') }}";
            }

            // Select All Checkbox for Positif
            $('#selectAllPositif').click(function() {
                $('.selectPositif').prop('checked', this.checked);
            });

            // Select All Checkbox for Negatif
            $('#selectAllNegatif').click(function() {
                $('.selectNegatif').prop('checked', this.checked);
            });

            // Delete Selected Rows for Poin Positif
            $('#deletePositif').click(function() {
                var selected = [];
                $('.selectPositif:checked').each(function() {
                    selected.push($(this).val());
                });
                if (selected.length > 0) {
                    $.ajax({
                        url: "{{ route('deletePoinPositif') }}",
                        method: 'POST',
                        data: {
                            ids: selected,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                } else {
                    alert('Pilih poin positif yang ingin dihapus');
                }
            });

            // Delete Selected Rows for Poin Negatif
            $('#deleteNegatif').click(function() {
                var selected = [];
                $('.selectNegatif:checked').each(function() {
                    selected.push($(this).val());
                });
                if (selected.length > 0) {
                    $.ajax({
                        url: "{{ route('deletePoinNegatif') }}",
                        method: 'POST',
                        data: {
                            ids: selected,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                } else {
                    alert('Pilih poin negatif yang ingin dihapus');
                }
            });
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endif
</body>
</html>
