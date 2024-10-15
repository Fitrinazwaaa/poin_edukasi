<html lang="en">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <title>Document</title>
       <link rel="stylesheet" href="{{ asset('css/formulir.css') }}">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body class="body">
       @extends('navbar/nav-form')
       
       <p class="text-center">FORMULIR EDIT DATA SISWA</p>
       <div class="container">
           <form method="POST" action="{{ route('SiswaUpdate', $data['nis']) }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <label for="nis">Nis</label>
                    <input type="text" name="nis" value="{{ $data['nis'] }}" class="form-control">
                </div>

                <div class="form-row">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ $data['nama'] }}" class="form-control">
                </div>

                <div class="form-row">
                    <label for="tingkatan">Kelas</label>
                    <input type="text" name="tingkatan" value="{{ $data['tingkatan'] }}" class="form-control">
                    <input type="text" name="jurusan" value="{{ $data['jurusan'] }}" class="form-control">
                    <input type="text" name="jurusan_ke" value="{{ $data['jurusan_ke'] }}" class="form-control">
                </div>
   
                <div class="form-row">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option @if($data['jenis_kelamin']=='Laki-Laki') selected @endif value="Laki-Laki" >Laki-Laki</option>
                        <option @if($data['jenis_kelamin']=='Perempuan') selected @endif value="Perempuan" >Perempuan</option>
                    </select>
                </div>                       
   
                <div class="form-row">
                    <label for="tahun_angkatan">Tahun Angkatan</label>
                    <input type="text" name="tahun_angkatan" value="{{ $data['tahun_angkatan'] }}"class="form-control">
                </div>
    
                <div class="button-group">
                    <button type="button" class="btn-dua" onclick="window.location.href='{{ route('Siswa') }}';">Kembali</button>
                    <button type="submit" class="btn-satu" >Perbaharui</button>
                </div>
           </form>
       </div>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>