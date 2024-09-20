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
       
       <p class="text-center">FORMULIR INPUT DATA SISWA</p>
       <div class="container">
          <form>
               <div class="form-row">
                   <label for="nama">Nama</label>
                   <input type="text" name="nama" class="form-control">
               </div>
   
               <div class="form-row">
                   <label for="kelas">Kelas</label>
                   <select name="kelas" class="form-control" style="margin-right:30px;">
                       <option value="" style="color: #ccc;" disabled selected>Pilih kelas</option>
                       <option value="10">10</option>
                       <option value="11">11</option>
                       <option value="12">12</option>
                   </select>
                   <select name="kelas" class="form-control" style="margin-right:30px;">
                       <option value="" style="color: #ccc;" disabled selected>Pilih kelas</option>
                       <option value="Teknik Kendaraan Ringan">Teknik Otomotif</option>
                       <option value="Akuntansi">Akuntansi</option>
                       <option value="Menejemen Perkantoran">Perkantoran</option>
                       <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                       <option value="Gim">Perkantoran</option>
                       <option value="Teknik Komputer Jaringan">Perkantoran</option>
                       <option value="Desain Permodelan Dan Informasi Bangunan">Perkantoran</option>
                       <option value="Seni Karawitan">Perkantoran</option>
                   </select>
                   <select name="kelas" class="form-control">
                       <option value="" style="color: #ccc;" disabled selected>Pilih kelas</option>
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                   </select>
               </div>
   
               <div class="form-row">
                   <label for="nis">Nis</label>
                   <input type="text" name="nis" class="form-control">
               </div>
   
               <div class="form-row">
                   <label for="jenis_kelamin">Jenis Kelamin</label>
                   <select name="jenis_kelamin" class="form-control">
                       <option value="" style="color: #ccc;" disabled selected>Pilih Jenis Kelamin</option>
                       <option value="laki-laki">Laki-Laki</option>
                       <option value="perempuan">Perempuan</option>
                   </select>
               </div>
   
               <div class="button-group">
                   <button type="button" class="btn-dua" onclick="window.location.href='{{ route('Siswa') }}';">Kembali</button>
                   <button type="button" class="btn-satu" onclick="window.location.href='{{ route('EditSiswa') }}';">Kirim</button>
               </div>
           </form>
       </div>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>