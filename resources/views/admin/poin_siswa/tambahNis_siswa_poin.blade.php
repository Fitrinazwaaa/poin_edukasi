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

    <p class="text-center">FORMULIR INPUT POIN DENGAN NIS</p>
    <div class="container">
        <form>
            <div class="form-row">
                <label for="nama">NIS</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nomor NIS Siswa" >
            </div>

            <div class="form-row">
                <label for="tipe_poin">Tipe Poin</label>
                <div>
                    <label><input type="radio" name="tipe_poin" value="Negatif"> Negatif</label>
                    <label><input type="radio" name="tipe_poin" value="Positif"> Positif</label>
                </div>
            </div>

            <div class="form-row">
                <label for="keterangan">Keterangan</label>
                <select name="keterangan" class="form-control">
                    <option value="" disabled selected>Pilih Jenis Peraturan</option>
                    <option value="101">Senin-Selasa tidak berpakaian PSAS (baju putih-celana/rok abu), “kerudung putih” bagi perempuan</option>
                    <option value="102">Senin-Selasa tidak berkaos kaki putih</option>
                </select>         
            </div>

            <div class="button-group">
                <button type="button" class="btn-dua" onclick="window.location.href='{{ route('TipePoinSiswa') }}';">Kembali</button>
                <button type="button" class="btn-satu" onclick="window.location.href='{{ route('TambahNamaPoinSiswa') }}';">Kirim</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>