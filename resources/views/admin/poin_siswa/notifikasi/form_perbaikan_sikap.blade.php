 
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
       
       <p class="text-center">FORMULIR PERBAIKAN SIKAP SISWA</p>
       <div class="container">
           <form method="POST" action="{{ route('SiswaStore') }}">
              @csrf
              @method('PUT')
                <div class="form-row">
                    <label for="guru">Nama Pengisi</label>
                    <input type="text" name="guru" class="form-control">
                </div>
                <div class="form-row">
                    <label for="siswa">Nama Siswa</label>
                    <input type="text" name="siswa" class="form-control">
                </div>
                <div class="form-row">
                    <label for="nis">Nis</label>
                    <input type="text" name="nis" class="form-control">
                </div>
                <div class="form-row">
                    <label for="kelas">Kelas</label>
                    <input type="text" name="kelas" class="form-control">
                </div>
                <div class="form-row">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="" disabled selected></option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-row">
                    <label for="positif">Perilaku Baik</label>
                    <input type="text" name="positif" class="form-control">
                </div>
                <div class="form-row">
                    <label for="photo">Bukti Aktifitas</label>
                    <input type="file" id="photoUpload" name="photo" accept="image/*">
                </div>
               <div class="button-group">
                   <button type="button" class="btn-dua" onclick="window.location.href='{{ route('PoinSiswa') }}';">Kembali</button>
                   <button type="submit" class="btn-satu" >Kirim</button>
               </div>
           </form>
       </div>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>