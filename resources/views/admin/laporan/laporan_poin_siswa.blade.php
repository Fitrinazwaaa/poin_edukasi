@extends('navbar/nav-Laporan')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/laporan/laporan_poin_siswa.css') }}">
</head>
<body>
    <h1>Laporan Poin Siswa</h1>
    <div class="button-container">
        <a href="{{ route('laporan.poin.siswa.downloadPdf') }}" class="btn btn-primary">Unduh PDF</a>
        <a href="{{ route('laporan.poin.siswa.exportExcel') }}" class="btn btn-primary">Unduh Excel</a>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered">
            @if($poinPelajar && count($poinPelajar) > 0)
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NAMA</th>
                    <th>JENIS KELAMIN</th>
                    <th>KELAS</th>
                    <th>TOTAL<br>POIN</th>
                    <th>KETERANGAN</th>
                    <th style="width:114px;">WAKTU</th>
                </tr>
            </thead>
            <tbody>
                @foreach($poinPelajar as $key => $groupedPoin)
                    @php
                        $poinPertama = $groupedPoin->first(); // Mengambil item pertama dari grup
                        $poinPositif = $groupedPoin->where('poin_positif', '>', 0);
                        $poinNegatif = $groupedPoin->where('poin_negatif', '>', 0);
                    @endphp
                    <tr>
                        <td rowspan="2">{{ $loop->iteration }}</td>
                        <td rowspan="2">{{ $poinPertama->nis }}</td>
                        <td rowspan="2" class="left-align">{{ $poinPertama->nama }}</td>
                        <td rowspan="2">{{ $poinPertama->jenis_kelamin }}</td>
                        <td rowspan="2">{{ $poinPertama->tingkatan }} {{ $poinPertama->jurusan }} {{ $poinPertama->jurusan_ke }}</td>
                        <td>
                            @if($poinPositif->count() > 0)
                                Positif
                                <br>{{ $poinPositif->sum('poin_positif') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <ol>
                                @if($poinPositif->count() > 0)
                                @foreach($poinPositif as $positif)
                                <li>{{ $positif->nama_poin_positif }}</li>
                                @endforeach
                                @else
                                -
                                @endif
                            </ol>
                        </td>
                        <td>
                            <ol>
                                @if($poinPositif->count() > 0)
                                    @foreach($poinPositif as $positif)
                                        <li>{{ $positif->created_at->format('d-m-Y') }}</li>
                                        @endforeach
                                        @else
                                    -
                                    @endif
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($poinNegatif->count() > 0)
                            Negatif
                                <br>{{ $poinNegatif->sum('poin_negatif') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <ol>
                                @if($poinNegatif->count() > 0)
                                    @foreach($poinNegatif as $negatif)
                                        <li>{{ $negatif->nama_poin_negatif }}</li>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </ol>
                        </td>
                        <td>
                            <ol>
                                @if($poinNegatif->count() > 0)
                                    @foreach($poinNegatif as $negatif)
                                        <li>{{ $negatif->created_at->format('d-m-Y') }}</li>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </ol>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            @else
                <tr>
                    <td colspan="8" style="text-align:center; color: #888;">Tidak ada data poin pelajar.</td>
                </tr>
            @endif
        </table>
    </div>
</body>
</html>  
@endsection
