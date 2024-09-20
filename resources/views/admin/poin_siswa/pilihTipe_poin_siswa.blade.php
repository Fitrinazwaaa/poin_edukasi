<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipe Input Poin (Guru)</title>
    <link rel="stylesheet" href="{{ asset('css/admin/poin_siswa/pilihTipe_poin_siswa.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #e7f4ff;">
    @extends('navbar/nav-form')
    <div class="container">
        <div class="card">
            <h2>Pilih Type</h2>
            <div class="button-container">
                <button class="btn1" onclick="window.location.href='{{ route('TambahNamaPoinSiswa') }}';">
                    Menggunakan Nama
                </button>
                <button class="btn1" onclick="window.location.href='{{ route('TambahNisPoinSiswa') }}';">
                    Menggunakan NIS
                </button>
            </div>
                <a href="{{ route('PoinSiswa') }}" class="back-btn">
                    <div class="arrow"></div> 
                    Back
                </a>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>