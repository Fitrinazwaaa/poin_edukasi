<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daftar Siswa SMK</title>
        <style>
            /* CSS seperti sebelumnya */
            body {
                font-size: 12px;
                margin: 0;
                padding: 0;
                position: relative;
            }
            h1 {
                text-align: center;
                margin-bottom: 10px;
            }
            .year-angkatan {
                text-align: center;
                font-size: 14px;
                font-weight: bold;
                margin-bottom: 20px;
                margin-top: -5px;
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
            
            /* Tanda tangan */
            .signature-container {
                margin-top: 30px;
                page-break-after: always;
                text-align: right;
            }
            .signature {
                display: inline-block;
                width: 200px;
                text-align: center;
                padding: 10px;
            }
            .signature-line {
                border-top: 1px solid black;
                width: 100%;
                margin-top: 50px;
            }
            .signature-text {
                font-style: italic;
            }
            
            /* Keterangan waktu di kiri atas setiap halaman */
            .time-header {
                position: fixed;
                bottom: 10px;
                left: 10px;
                font-size: 10px;
                color: #333;
            }
            
            /* Memastikan header tidak menimpa konten */
            @page {
                margin-top: 40px;
            }
    </style>
</head>
<body>
    <div class="time-header">
        {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}
    </div>

    <h1>Laporan Poin Siswa SMKN 1 Kawali</h1>

    <div class="year-angkatan">
        Tahun Angkatan: {{ $tahunAngkatanMax }} - {{ $tahunAngkatanMax + 1 }}
    </div>

    <!-- Menampilkan Data Berdasarkan Kelas -->
    @foreach($poinPelajar as $kelas => $siswaKelas)
        <h4>{{ $kelas }}</h4>
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NAMA</th>
                    <th>JENIS KELAMIN</th>
                    <th>KELAS KONSENTRASI KEAHLIAN</th>
                    <th>POIN</th>
                    <th>KETERANGAN</th>
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
                        <td class="left-align">
                            <ol>
                                @if($poinPositif->count() > 0)
                                    @foreach($poinPositif as $positif)
                                        <li>{{ $positif->tanggal}}</li>
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
                        <td class="left-align">
                            <ol>
                                @if($poinNegatif->count() > 0)
                                    @foreach($poinNegatif as $negatif)
                                        <li>{{ $negatif->tanggal}}</li>
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

    <div class="signature-container">
        <div class="signature">
            <p class="signature-text">Kesiswaan,</p><br><br>
            <div class="signature-line"></div>
            <p style="text-align: left; margin-top: 0;">NIP :</p>
        </div>
    </div>

    <div class="time-header">
        {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}
    </div>
</body>
</html>