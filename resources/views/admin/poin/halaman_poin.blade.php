<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin/poin/halaman_poin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<body>
    @extends('navbar/nav-utama')
{{-- TIPE POIN --}}
<div class="tipe-poin">
    <div class="tipe">
        <a href="javascript:void(0)" id="negatif-link" class="active" onclick="showTable('negatif')">Negatif</a>
        <a href="javascript:void(0)" id="positif-link" onclick="showTable('positif')">Positif</a>
        <div class="tambah_dan_hapus">
            <button class="icon-btn delete-btn" style="padding-top: 10px; padding-bottom:10px;"><i class="fas fa-trash-alt"></i></button>
            <button class="tambah" onclick="window.location.href='{{ route('TambahSiswa') }}';">
                <i class="fas fa-plus"></i> Tambahkan
            </button>
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="tabel">
    <div id="negatif-table" style="display: none;">
        @include('admin.poin.negatif')
    </div>
    <div id="positif-table" style="display: none;">
        @include('admin.poin.positif')
    </div>
</div>

<script>
    function showTable(type) {
        const negatifTable = document.getElementById('negatif-table');
        const positifTable = document.getElementById('positif-table');
        const negatifLink = document.getElementById('negatif-link');
        const positifLink = document.getElementById('positif-link');

        // Hide both tables
        negatifTable.style.display = 'none';
        positifTable.style.display = 'none';

        // Remove active classes
        negatifLink.classList.remove('active', 'negative-active');
        positifLink.classList.remove('active', 'positive-active');

        // Show the selected table
        if (type === 'negatif') {
            negatifTable.style.display = 'block';
            negatifLink.classList.add('active', 'negative-active');
        } else if (type === 'positif') {
            positifTable.style.display = 'block';
            positifLink.classList.add('active', 'positive-active');
        }
    }

    // Default: Show negatif table on page load
    showTable('negatif');
</script>
    
    
    <div class="container">
        <div class="table-wrapper3">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peringatan</th>
                        <th>Poin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Teguran lisan</td>
                        <td>&gt;=12</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Peringatan tertulis</td>
                        <td>&gt;=8</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Peringatan tertulis disampaikan kepada orang tua</td>
                        <td>&gt;=22</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Pemanggilan orang tua</td>
                        <td>&gt;=50</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Siswa dan orang tua membuat surat perjanjian bermaterai</td>
                        <td>&gt;=75</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Siswa di skors selama 3 hari</td>
                        <td>&gt;=100</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Siswa di skors selama 6 hari</td>
                        <td>&gt;=135</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Siswa dikembalikan kepada orang tua</td>
                        <td>&gt;=200</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>