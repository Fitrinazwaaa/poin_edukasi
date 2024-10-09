<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/formulir.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="body">
    @extends('navbar/nav-form')

    @section('content')
    <p class="text-center">FORMULIR INPUT POIN DENGAN NIS</p>
    <div class="container">

        <form action="{{ route('StoreNisPoinSiswa') }}" method="POST">
            @csrf
            <div class="form-row">
                <label for="nis">NIS</label>
                <input type="text" name="nis" id="nis" class="form-control" required>
            </div>

            <div class="form-row">
                <label for="tipe_poin">Tipe Poin</label><br>
                <div>
                <p style="margin-right: 50px;"><input type="radio" name="tipe_poin[]" value="positif" style="margin-right: 10px;">Positif</p>
                <p style="margin-right: 50px;"><input type="radio" name="tipe_poin[]" value="negatif" style="margin-right: 10px;">Negatif</p>
                </div>
            </div>

            <div class="form-row">
                <label for="np">Nama Pelanggaran</label>
                <input type="text" name="np" id="np" class="form-control" required>
            </div>

            <div class="button-group">
                <button type="button" class="btn-dua" onclick="window.location.href='{{ route('TipePoinSiswa') }}';">Kembali</button>
                <button type="submit" class="btn-satu">Tambah Poin</button>
            </div>
        </form>

    </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>