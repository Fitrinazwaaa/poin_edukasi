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

    <h2 class="text-center">{{ $poinPeringatan8->peringatan }}</h2>
    <p class="text-center">Poin Negatif >{{ $poinPeringatan8->max_poin }}</p>

    @foreach($dataSiswa as $siswa)
        @php
            // Tentukan kelas berdasarkan jenis kelamin
            $cardClass = $siswa->jenis_kelamin === 'Perempuan' ? 'card_pink' : 'card_blue';
            $hrClass = $siswa->jenis_kelamin === 'Perempuan' ? 'pink-hr' : 'blue-hr';
        @endphp

            <div class="{{ $cardClass }}">
                <h4>{{ $siswa->nama }}</h4>
                <p class="right bottom">Poin Negatif: {{ $siswa->jumlah_negatif }}</p>
                <hr class="{{ $hrClass }}">
                <p>{{ $siswa->nis }}</p>
                <!-- Tambahkan container untuk kelas dan tombol -->
                <div class="class-button-container">
                    <p class="kelas">{{ $siswa->tingkatan}} {{ $siswa->jurusan}} {{ $siswa->jurusan_ke}}</p>

                    <button class="perbaikan" onclick="window.location.href='{{ route('CreatePerbaikan', ['nis' => $siswa->nis]) }}'">Perbaikan</button>
                </div>
            </div>
    @endforeach
</body>
</html>
