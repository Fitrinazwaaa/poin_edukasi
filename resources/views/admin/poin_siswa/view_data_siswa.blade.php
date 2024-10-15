<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Header dan Tabel Poin Siswa</title>
    <link rel="stylesheet" href="{{ asset('css/admin/poin_siswa/view_data_siswa.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- Profile Header -->
@if($siswa)
<div class="profile-header">
<div class="back-button">
<button onclick="goBack()" style="border:none; background-color: white;">
    <span>&larr;</span>
</button>
</div>


    <div class="profile-info">
        <div class="profile-image">
            <img src="https://cdn-icons-png.flaticon.com/512/9449/9449194.png" alt="Profile Image">
        </div>
        <div class="profile-details">
            <div class="profile-id">{{ $siswa->nis }}</div>
            <div class="profile-name">{{ $siswa->nama }}</div>
        </div>
    </div>
    <div class="profile-meta">
        <div class="profile-gender">{{ $siswa->jenis_kelamin }}</div>
        <div class="profile-class">{{ $siswa->tingkatan }} {{ $siswa->jurusan }} {{ $siswa->jurusan_ke }}</div>
    </div>
</div>

<!-- Container untuk tabel poin -->
<div class="container">
    <!-- Poin Positif -->
    <div class="table-section">
        <h3>
            POIN POSITIF 
            <button class="delete-icon" id="deletePositif">hapus</button>
        </h3>
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
    <div class="table-section">
        <h3>
            POIN NEGATIF
            <button class="delete-icon" id="deleteNegatif">hapus</button>
        </h3>
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
<p>Data siswa tidak ditemukan</p>
@endif

<script>
    function goBack() {
        // Refresh halaman sebelumnya sebelum kembali
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
        if(selected.length > 0) {
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
        if(selected.length > 0) {
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
</body>
</html>
