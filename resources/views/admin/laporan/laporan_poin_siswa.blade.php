<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/laporan/laporan_poin_siswa.css') }}">
</head>
<body>
    @extends('navbar/nav-form')

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>NIS</th>
                <th>NAMA</th>
                <th>JENIS KELAMIN</th>
                <th>KELAS</th>
                <th>POINT</th>
                <th>KETERANGAN</th>
                <th>WAKTU</th>
            </tr>
        </thead>
        <tbody>
    @if($poinPelajar && count($poinPelajar) > 0)
        @foreach($poinPelajar->groupBy('nis') as $key => $groupedPoin)
        @php
            $poinPertama = $groupedPoin->first();
            $poinPositif = $groupedPoin->where('poin_positif', '>', 0);
            $poinNegatif = $groupedPoin->where('poin_negatif', '>', 0);
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td style="text-align:center">{{ $poinPertama->nis }}</td>
            <td>{{ $poinPertama->nama }}</td>
            <td style="text-align:center">{{ $poinPertama->jenis_kelamin}}</td>
            <td style="text-align:center">{{ $poinPertama->tingkatan }} {{ $poinPertama->jurusan }} {{ $poinPertama->jurusan_ke }}</td>
            <td>
                @if($poinPositif->count() > 0)
                    Positif: {{ $poinPositif->sum('poin_positif') }}
                @endif
                @if($poinNegatif->count() > 0)
                    <br>Negatif: {{ $poinNegatif->sum('poin_negatif') }}
                @endif
            </td>
            <td>
                Positif: 
                <ol>
                    @foreach($poinPositif as $positif)
                    <li>{{ $positif->nama_poin_positif }}</li>
                    @endforeach
                </ol>
                Negatif: 
                <ol>
                    @foreach($poinNegatif as $negatif)
                    <li>{{ $negatif->nama_poin_negatif }}</li>
                    @endforeach
                </ol>
            </td>
            <td>
                Positif: 
                <ol>
                    @foreach($poinPositif as $positif)
                    <li>{{ $positif->created_at->format('d-m-Y') }}</li>
                    @endforeach
                </ol>
                Negatif: 
                <ol>
                    @foreach($poinNegatif as $negatif)
                    <li>{{ $negatif->created_at->format('d-m-Y') }}</li>
                    @endforeach
                </ol>
            </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="9">Tidak ada data poin pelajar.</td>
        </tr>
    @endif
    </tbody>
    </table>
</body>
</html>
