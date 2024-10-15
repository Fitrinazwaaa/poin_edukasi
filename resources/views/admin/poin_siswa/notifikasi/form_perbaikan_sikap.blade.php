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

        <form action="{{ route('StoreNamaPoinSiswa' , $data['nis']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <label for="tingkatan">Kelas</label>
                <input type="text" name="tingkatan" value="{{ $data['tingkatan'] }}" class="form-control" readonly>
                <input type="text" name="jurusan" value="{{ $data['jurusan'] }}" class="form-control" readonly>
                <input type="text" name="jurusan_ke" value="{{ $data['jurusan_ke'] }}" class="form-control" readonly>
            </div>

            <div class="form-row">
                <label for="nama">Nama</label>
                <input type="text" name="nama" value="{{ $data['nama'] }}" class="form-control" readonly>
            </div>
            
            <div class="form-row">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <input type="text" name="jenis_kelamin" value="{{ $data['jenis_kelamin'] }}" class="form-control" readonly>
            </div>

            <div class="form-row">
                <label for="tipe_poin">Tipe Poin</label><br>
                <div>
                    <label style="margin-right: 50px;">
                        <input type="radio" name="tipe_poin" value="positif" style="margin-right: 10px;">Positif
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
