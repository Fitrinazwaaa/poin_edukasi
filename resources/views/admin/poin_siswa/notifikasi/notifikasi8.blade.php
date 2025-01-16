<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi 1</title>
    <link rel="stylesheet" href="{{ asset('css/notifikasi-peringatan.css') }}">
    <style>
        .hidden {
            display: none;
        }
        .search-container {
            margin: 20px auto;
            text-align: center;
        }
        .search-container .input-group {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .search-container .form-control {
            border: none;
            font-size: 14px;
            padding: 10px;
            flex: 1;
            border-radius: 5px 0 0 5px;
            border: 1px solid #fcfc38;
        }
        .search-container .label {
            background-color: #fcfc38;
            color: black;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border-radius: 5px 0 0 5px;
            cursor: default;
        }
        .search-container .clear-input {
            position: absolute;
            right: 60px;
            top: 10px;
            cursor: pointer;
            display: none;
            font-size: 18px;
            color: #dc3545;
        }
        .search-container .clear-input:hover {
            color: #b52d37;
        }
    </style>
</head>
<body>
    @extends('navbar/nav-notifikasi')

    <h5 class="text-center">{{ $poinPeringatan8->peringatan }}</h5>
    <p class="text-center">Poin Negatif >{{ $poinPeringatan8->max_poin }}</p>

    <!-- Input untuk pencarian -->
    <div class="search-container">
        <div class="input-group">
            <div class="label">Cari Data</div>
            <input type="text" class="form-control" id="searchInput" placeholder="Cari nama, NIS, atau kelas...">
            <span class="clear-input" id="clearInput" onclick="clearSearch()">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>

    <div id="cardsContainer">
        @foreach($dataSiswa as $siswa)
            @php
                // Tentukan kelas berdasarkan jenis kelamin
                $cardClass = $siswa->jenis_kelamin === 'Perempuan' ? 'card_pink' : 'card_blue';
                $hrClass = $siswa->jenis_kelamin === 'Perempuan' ? 'pink-hr' : 'blue-hr';
            @endphp

            <div class="{{ $cardClass }} card-item" data-name="{{ $siswa->nama }}" data-nis="{{ $siswa->nis }}" data-kelas="{{ $siswa->tingkatan }} {{ $siswa->jurusan }} {{ $siswa->jurusan_ke }}">
                <h4>{{ $siswa->nama }} -  {{ $siswa->nis }}</h4>
                <p class="right bottom">Poin Negatif: {{ $siswa->jumlah_negatif }}</p>
                <hr class="{{ $hrClass }}">

                <!-- Tambahkan container untuk kelas dan tombol -->
                <div class="class-button-container">
                    <p class="kelas">Kelas :  {{ $siswa->tingkatan}} {{ $siswa->jurusan}} {{ $siswa->jurusan_ke}}</p>
                    <button class="perbaikan" onclick="window.location.href='{{ route('CreatePerbaikan', ['nis' => $siswa->nis]) }}'">Perbaikan</button>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function filterCards() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.card-item');

            if (input.trim() === '') {
                cards.forEach(card => card.classList.remove('hidden'));
                return;
            }

            cards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                const nis = card.getAttribute('data-nis').toLowerCase();
                const kelas = card.getAttribute('data-kelas').toLowerCase();

                if (name.includes(input) || nis.includes(input) || kelas.includes(input)) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        }

        function clearSearch() {
            document.getElementById('searchInput').value = '';
            filterCards();
            document.getElementById('clearInput').style.display = 'none';
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            const clearIcon = document.getElementById('clearInput');
            if (this.value) {
                clearIcon.style.display = 'block';
                filterCards();
            } else {
                clearIcon.style.display = 'none';
                filterCards();
            }
        });
    </script>
</body>
</html>
