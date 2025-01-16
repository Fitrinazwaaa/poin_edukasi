 
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
       @extends('navbar/nav-kelas')
       
       <p class="text-center">FORMULIR TAMBAH DATA KELAS</p>
       <div class="container">
            <form method="POST" action="{{ route('KelasStore') }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <label for="tahun_angkatan">Tahun Angkatan</label>
                    <input type="text" name="tahun_angkatan" class="form-control" required>
                </div>

                <div class="form-row">
                    <label for="jurusan">jurusan</label>
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
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>