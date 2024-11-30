<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa SMK</title>
    <style>
        body {
            
            font-size: 12px;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        h4 {
            margin: 10px 0;
            font-size: 14px;
            text-align: left;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            font-size: 9px;
            vertical-align: middle;
        }
        th {
            background-color: #f2f2f2;
            font-size: 11px;
            text-align: center;
        }
        td {
            text-align: center;
        }
        td.left-align {
            text-align: left;
        }
        ol {
            padding-left: 15px;
            margin: 0;
        }
        img {
            width: 50px; /* Adjust width as necessary */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <h3>Laporan Poin Siswa</h3>

    @foreach($poinPelajar as $kelas => $siswaKelas)
        <h4>{{ $kelas }}</h4>
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NAMA</th>
                    <th>JENIS KELAMIN</th>
                    <th>KELAS</th>
                    <th>POIN</th>
                    <th>KETERANGAN</th>
                    <th>FOTO</th>
                    <th style="width: 65px;">WAKTU</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswaKelas->groupBy('nis') as $key => $groupedPoin)
                    @php
                        $poinPertama = $groupedPoin->first();
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
                                Positif: {{ $poinPositif->sum('poin_positif') }}
                            @else
                                - 
                            @endif
                        </td>
                        <td class="left-align">
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
                            - 
                        </td>
                        <td class="left-align">
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
                                Negatif: {{ $poinNegatif->sum('poin_negatif') }}
                            @else
                                - 
                            @endif
                        </td>
                        <td class="left-align">
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
                                @if($poinPertama->foto) <!-- Check if the photo exists -->
                                    <li><img src="{{ asset($poinPertama->foto) }}" alt="{{ $poinPertama->nama }}'s photo"></li>
                                @else
                                    <img src="{{ asset('path/to/default/photo.jpg') }}" alt="Default photo"> <!-- Default photo if none exists -->
                                @endif
                            </ol>
                        </td>
                        <td class="left-align">
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
        </table>
    @endforeach
</body>
</html>
