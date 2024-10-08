<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
            <div class="form-row">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
                <div id="namaList"></div>
            </div>

            <div class="form-row">
                <label for="kelas">Kelas</label>
                <input type="text" name="kelas" id="kelas" class="form-control" required>
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
                <p style="margin-right: 50px;"><input type="radio" name="tipe_poin[]" value="positif" style="margin-right: 10px;">Positif</p>
                <p style="margin-right: 50px;"><input type="radio" name="tipe_poin[]" value="negatif" style="margin-right: 10px;">Negatif</p>
                </div>
            </div>

            <div class="form-row">
                <label for="np">np</label>
                <input type="text" name="np" id="np" class="form-control" required>
            </div>

            <div class="button-group">
                <button type="button" class="btn-dua" onclick="window.location.href='{{ route('TipePoinSiswa') }}';">Kembali</button>
                <button type="submit" class="btn-satu">Tambah Poin</button>
            </div>
        </form>
        
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#nama').keyup(function() {
                var query = $(this).val();
                if (query != '') {
                    $.ajax({
                        url: "{{ route('SearchNamaPoinSiswa') }}",
                        method: "GET",
                        data: { query: query },
                        success: function(data) {
                            $('#namaList').fadeIn();
                            $('#namaList').html(data.map(function(item) {
                                return '<li class="list-row-item" data-id="' + item.nis + '" data-kelas="' + item.kelas + '" data-jenis_kelamin="' + item.jenis_kelamin + '">' + item.nama + '</li>';
                            }).join(''));
                        }
                    });
                }
            });

            $(document).on('click', 'li', function() {
                $('#nama').val($(this).text());
                $('#kelas').val($(this).data('kelas'));
                $('#jenis_kelamin').val($(this).data('jenis_kelamin'));
                $('#namaList').fadeOut();
            });
        });
    </script>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>