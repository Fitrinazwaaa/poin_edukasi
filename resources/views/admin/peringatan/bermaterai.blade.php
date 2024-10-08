<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISWA DAN ORANG TUA MEMBUAT SURAT PERJANTIAN BERMATRAI</title>
    <link rel="stylesheet" href="{{ asset('css/notifikasi-peringatan.css') }}">
</head>
<body>
    @extends('navbar/nav-form')

    @foreach($poinPeringatan5 as $peringatan)
        <h2 class="text-center">{{ $peringatan->judul }}</h2>
        <h4 class="text-center">Poin Negatif {{ $peringatan->max_poin }} @foreach($poinPeringatan6 as $peringatan) - {{ $peringatan->max_poin }} @endforeach</h4>
    @endforeach

    @foreach($dataSiswa as $siswa)
        @php
            // Tentukan kelas berdasarkan jenis kelamin
            $cardClass = $siswa->jenis_kelamin === 'Perempuan' ? 'card_pink' : 'card_blue';
            $hrClass = $siswa->jenis_kelamin === 'Perempuan' ? 'pink-hr' : 'blue-hr';
        @endphp

        <div class="{{ $cardClass }}">
            <h3>{{ $siswa->nama }}</h3>
            <p class="right">{{ $siswa->kelas }}</p>
            <hr class="{{ $hrClass }}">
            <p>{{ $siswa->nis }}</p>
            <p class="right bottom">Poin Negatif: {{ $siswa->poin_negatif }}</p>
        </div>
    @endforeach
</body>
</html>
