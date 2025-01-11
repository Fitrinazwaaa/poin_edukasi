@extends('navbar/nav-Laporan')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa SMK</title>
    <link rel="stylesheet" href="{{ asset('css/admin/laporan/laporan_poin_siswa.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    @if (Auth::user()->role == 'user_edit')
        {{-- NAVBAR - START --}}
        <!-- SEARCHING START -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">PILIH DATA BERDASARKAN KATEGORI</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{ route('LaporanPoinSiswa') }}" method="GET" class="search-form">
                            <input type="text" name="kelas" placeholder="Cari Kelas atau Konsentrasi Keahlian" value="{{ request('kelas') }}">
                            <input type="text" name="nis" placeholder="Cari NIS" value="{{ request('nis') }}">
                            <input type="text" name="nama" placeholder="Cari Nama" value="{{ request('nama') }}">
                            <select name="jenis_kelamin">
                                <option value="">Semua</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <input type="month" name="bulan" value="{{ request('bulan') }}">            
                            <button class="btn btn-primary-cari" type="submit" style="width: 100px;">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- SEARCHING END -->

        <div class="button-container">
            <a href="{{ route('laporan.poin.siswa.downloadPdf', request()->all()) }}" class="btn btn-primary">Unduh PDF</a>
            <a href="{{ route('laporan.poin.siswa.EksportExcel', request()->all()) }}" class="btn btn-primary">Unduh Excel</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Kategorikan</button>
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
                        <th>KELAS KONSENTRASI KEAHLIAN</th>
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
                                            <li>
                                                @if($negatif->foto)
                                                    <img src="{{ asset('storage/' . $negatif->foto) }}" alt="Foto Negatif" width="100px" style="margin-bottom: 8px;">
                                                @endif
                                                {{ $negatif->nama_poin_negatif }}
                                            </li>
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
                @else
                    <tr>
                        <td colspan="8" style="text-align:center; color: #888;">Tidak ada data poin pelajar.</td>
                    </tr>
                @endif
            </table>
        </div>



    @elseif (Auth::user()->role == 'user1')
        {{-- NAVBAR - START --}}
        <!-- <h1>Laporan Poin Siswa</h1> -->
        
        <!-- SEARCHING START -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">PILIH DATA BERDASARKAN KATEGORI</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{ route('LaporanPoinSiswa') }}" method="GET" class="search-form">
                            <input type="text" name="kelas" placeholder="Cari Kelas atau Konsentrasi Keahlian" value="{{ request('kelas') }}">
                            <input type="text" name="nis" placeholder="Cari NIS" value="{{ request('nis') }}">
                            <input type="text" name="nama" placeholder="Cari Nama" value="{{ request('nama') }}">
                            <select name="jenis_kelamin">
                                <option value="">Semua</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <input type="month" name="bulan" value="{{ request('bulan') }}">            
                            <button class="btn btn-primary-cari" type="submit" style="width: 100px;">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- SEARCHING END -->

        <div class="button-container">
            <a href="{{ route('laporan.poin.siswa.downloadPdf', request()->all()) }}" class="btn btn-primary">Unduh PDF</a>
            <a href="{{ route('laporan.poin.siswa.EksportExcel', request()->all()) }}" class="btn btn-primary">Unduh Excel</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Kategorikan</button>
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
                        <th>KELAS KONSENTRASI KEAHLIAN</th>
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
                                            <li>
                                                @if($negatif->foto)
                                                    <img src="{{ asset('storage/' . $negatif->foto) }}" alt="Foto Negatif" width="100px" style="margin-bottom: 8px;">
                                                @endif
                                                {{ $negatif->nama_poin_negatif }}
                                            </li>
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
                @else
                    <tr>
                        <td colspan="8" style="text-align:center; color: #888;">Tidak ada data poin pelajar.</td>
                    </tr>
                @endif
            </table>
        </div>



    @elseif (Auth::user()->role == 'user2')
        {{-- NAVBAR - START --}}
        <!-- <h1>Laporan Poin Siswa</h1> -->
        
        <!-- SEARCHING START -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">PILIH DATA BERDASARKAN KATEGORI</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{ route('LaporanPoinSiswa') }}" method="GET" class="search-form">
                            <input type="text" name="kelas" placeholder="Cari Kelas atau Konsentrasi Keahlian" value="{{ request('kelas') }}">
                            <input type="text" name="nis" placeholder="Cari NIS" value="{{ request('nis') }}">
                            <input type="text" name="nama" placeholder="Cari Nama" value="{{ request('nama') }}">
                            <select name="jenis_kelamin">
                                <option value="">Semua</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <input type="month" name="bulan" value="{{ request('bulan') }}">            
                            <button class="btn btn-primary-cari" type="submit" style="width: 100px;">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- SEARCHING END -->

        <div class="button-container">
            <a href="{{ route('laporan.poin.siswa.downloadPdf', request()->all()) }}" class="btn btn-primary">Unduh PDF</a>
            <a href="{{ route('laporan.poin.siswa.EksportExcel', request()->all()) }}" class="btn btn-primary">Unduh Excel</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Kategorikan</button>
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
                        <th>KELAS KONSENTRASI KEAHLIAN</th>
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
                                            <li>
                                                @if($negatif->foto)
                                                    <img src="{{ asset('storage/' . $negatif->foto) }}" alt="Foto Negatif" width="100px" style="margin-bottom: 8px;">
                                                @endif
                                                {{ $negatif->nama_poin_negatif }}
                                            </li>
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
                @else
                    <tr>
                        <td colspan="8" style="text-align:center; color: #888;">Tidak ada data poin pelajar.</td>
                    </tr>
                @endif
            </table>
        </div>



    @elseif (Auth::user()->role == 'user3')
        {{-- NAVBAR - START --}}
        <!-- <h1>Laporan Poin Siswa</h1> -->
        
        <!-- SEARCHING START -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">PILIH DATA BERDASARKAN KATEGORI</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{ route('LaporanPoinSiswa') }}" method="GET" class="search-form">
                            <input type="text" name="kelas" placeholder="Cari Kelas atau Konsentrasi Keahlian" value="{{ request('kelas') }}">
                            <input type="text" name="nis" placeholder="Cari NIS" value="{{ request('nis') }}">
                            <input type="text" name="nama" placeholder="Cari Nama" value="{{ request('nama') }}">
                            <select name="jenis_kelamin">
                                <option value="">Semua</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <input type="month" name="bulan" value="{{ request('bulan') }}">            
                            <button class="btn btn-primary-cari" type="submit" style="width: 100px;">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- SEARCHING END -->

        <div class="button-container">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Kategorikan</button>
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
                        <th>KELAS KONSENTRASI KEAHLIAN</th>
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
                                            <li>
                                                @if($negatif->foto)
                                                    <img src="{{ asset('storage/' . $negatif->foto) }}" alt="Foto Negatif" width="100px" style="margin-bottom: 8px;">
                                                @endif
                                                {{ $negatif->nama_poin_negatif }}
                                            </li>
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
                @else
                    <tr>
                        <td colspan="8" style="text-align:center; color: #888;">Tidak ada data poin pelajar.</td>
                    </tr>
                @endif
            </table>
        </div>


    @elseif (Auth::user()->role == 'user4')
        {{-- NAVBAR - START --}}
        <!-- SEARCHING START -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">PILIH DATA BERDASARKAN KATEGORI</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{ route('LaporanPoinSiswa') }}" method="GET" class="search-form">
                            <input type="text" name="kelas" placeholder="Cari Kelas atau Konsentrasi Keahlian" value="{{ request('kelas') }}">
                            <input type="text" name="nis" placeholder="Cari NIS" value="{{ request('nis') }}">
                            <input type="text" name="nama" placeholder="Cari Nama" value="{{ request('nama') }}">
                            <select name="jenis_kelamin">
                                <option value="">Semua</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <input type="month" name="bulan" value="{{ request('bulan') }}">            
                            <button class="btn btn-primary-cari" type="submit" style="width: 100px;">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- SEARCHING END -->

        <div class="button-container">
            <a href="{{ route('laporan.poin.siswa.downloadPdf', request()->all()) }}" class="btn btn-primary">Unduh PDF</a>
            <a href="{{ route('laporan.poin.siswa.EksportExcel', request()->all()) }}" class="btn btn-primary">Unduh Excel</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Kategorikan</button>
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
                        <th>KELAS KONSENTRASI KEAHLIAN</th>
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
                                            <li>
                                                @if($negatif->foto)
                                                    <img src="{{ asset('storage/' . $negatif->foto) }}" alt="Foto Negatif" width="100px" style="margin-bottom: 8px;">
                                                @endif
                                                {{ $negatif->nama_poin_negatif }}
                                            </li>
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
                @else
                    <tr>
                        <td colspan="8" style="text-align:center; color: #888;">Tidak ada data poin pelajar.</td>
                    </tr>
                @endif
            </table>
        </div>



    @elseif (Auth::user()->role == 'admin')
        {{-- NAVBAR - START --}}
        <!-- <h1>Laporan Poin Siswa</h1> -->
        <!-- SEARCHING START -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">PILIH DATA BERDASARKAN KATEGORI</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{ route('LaporanPoinSiswa') }}" method="GET" class="search-form">
                            <input type="text" name="kelas" placeholder="Cari Kelas atau Konsentrasi Keahlian" value="{{ request('kelas') }}">
                            <input type="text" name="nis" placeholder="Cari NIS" value="{{ request('nis') }}">
                            <input type="text" name="nama" placeholder="Cari Nama" value="{{ request('nama') }}">
                            <select name="jenis_kelamin">
                                <option value="">Semua</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <input type="month" name="bulan" value="{{ request('bulan') }}">            
                            <button class="btn btn-primary-cari" type="submit" style="width: 100px;">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- SEARCHING END -->

        <div class="button-container">
            <a href="{{ route('laporan.poin.siswa.downloadPdf', request()->all()) }}" class="btn btn-primary">Unduh PDF</a>
            <a href="{{ route('laporan.poin.siswa.EksportExcel', request()->all()) }}" class="btn btn-primary">Unduh Excel</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Kategorikan</button>
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
                        <th>KELAS KONSENTRASI KEAHLIAN</th>
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
                                            <li>
                                                @if($negatif->foto)
                                                    <img src="{{ asset('storage/' . $negatif->foto) }}" alt="Foto Negatif" width="100px" style="margin-bottom: 8px;">
                                                @endif
                                                {{ $negatif->nama_poin_negatif }}
                                            </li>
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
                @else
                    <tr>
                        <td colspan="8" style="text-align:center; color: #888;">Tidak ada data poin pelajar.</td>
                    </tr>
                @endif
            </table>
        </div>
        @else

        {{-- Logout user if the role is not valid --}}
        @php
            Auth::logout();
        @endphp
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endif
</body>
</html>
@endsection
