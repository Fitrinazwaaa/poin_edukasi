<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulir Input Poin</title>
    <link rel="stylesheet" href="{{ asset('css/formulir.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="body">
    @extends('navbar/nav-form')

    @section('content')
    <p class="text-center">FORMULIR INPUT POIN DENGAN DATA DIRI</p>
    <div class="container">

        <form action="{{ route('StoreNamaPoinSiswa') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <label for="tingkatan">Kelas</label>
                <select name="tingkatan" id="tingkatan" class="form-control" style="margin-right:30px;">
                    <option value="" style="color: #ccc;" disabled selected>Tingkatan</option>
                    @foreach ($tingkatanList as $tingkatan)
                        <option value="{{ $tingkatan }}">{{ $tingkatan }}</option>
                    @endforeach
                </select>
                <select name="jurusan" id="jurusan" class="form-control" style="margin-right:30px;" disabled>
                    <option value="" style="color: #ccc;" disabled selected>Jurusan</option>
                </select>
                <select name="jurusan_ke" id="jurusan_ke" class="form-control" disabled>
                    <option value="" disabled selected>Jurusan ke</option>
                </select>
            </div>

            <div class="form-row">
                <label for="nama">Nama</label>
                <select name="nama" id="nama" class="form-control" disabled>
                    <option value="" disabled selected>Nama siswa</option>
                </select>
            </div>

            <div class="form-row">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-row">
                <label for="tipe_poin">Tipe Poin</label><br>
                <div>
                    <label style="margin-right: 50px;">
                        <input type="radio" name="tipe_poin" value="positif" style="margin-right: 10px;">Positif
                    </label>
                    <label style="margin-right: 50px;">
                        <input type="radio" name="tipe_poin" value="negatif" style="margin-right: 10px;">Negatif
                    </label>
                </div>
            </div>

            <div class="form-row">
    <label for="nama_poin">Nama Poin</label>
    <select name="nama_poin" id="nama_poin" class="form-control" disabled>
        <option value="" disabled selected>Pilih Nama Poin</option>
    </select>
</div>



            <div class="button-group mt-3">
                <button type="button" class="btn-dua" onclick="window.location.href='{{ route('TipePoinSiswa') }}';">Kembali</button>
                <button type="submit" class="btn-satu">Tambah Poin</button>
            </div>
        </form>
        
    </div>

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
                $('#jurusan').append('<option value="" disabled selected>Pilih Jurusan</option>');
                $('#jurusan_ke').empty();
                $('#jurusan_ke').append('<option value="" disabled selected>Pilih Jurusan ke</option>');

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
                $('#jurusan_ke').append('<option value="" disabled selected>Pilih Jurusan ke</option>');

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
                $('#nama').append('<option value="" disabled selected>Pilih Nama</option>');
                


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
                $('#nama_poin').append('<option value="" disabled selected>Pilih Nama Poin</option>');

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
});


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
