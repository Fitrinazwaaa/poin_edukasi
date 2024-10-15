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
   
   <p class="text-center">FORMULIR TAMBAH DATA SISWA</p>
   <div class="container">
   @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

       <form method="POST" action="{{ route('SiswaStore') }}">
          @csrf
          @method('PUT')
            <div class="form-row">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="form-row">
                <label for="nis">Nis</label>
                <input type="text" name="nis" class="form-control">
            </div>

            <div class="form-row">
               <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
           </div>
           
            <div class="form-row">
                <label for="tahun_angkatan">Tahun Angkatan</label>
                <select name="tahun_angkatan" id="tahun_angkatan" class="form-control">
                    <option value="" disabled selected>Pilih Tahun Angkatan</option>
                    @foreach($tahun_angkatan as $tahun)
                        <option value="{{ $tahun->tahun_angkatan }}">{{ $tahun->tahun_angkatan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <label for="kelas">Kelas</label>

                <select name="tingkatan" class="form-control" style="margin-right:30px;">
                    <option value="" style="color: #ccc;" disabled selected>Tingkatan</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                </select>

                <select name="jurusan" id="jurusan" class="form-control" style="margin-right:30px;">
                    <option value="" style="color: #ccc;" disabled selected>Jurusan</option>
                </select>

                <select name="jurusan_ke" id="jurusan_ke" class="form-control">
                    <option value="" style="color: #ccc;" disabled selected>Jurusan ke</option>
                </select>
            </div>

           <div class="button-group">
               <button type="button" class="btn-dua" onclick="window.location.href='{{ route('Siswa') }}';">Kembali</button>
               <button type="submit" class="btn-satu" >Kirim</button>
           </div>
       </form>
   </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

   <script type="text/javascript">
        $('#tahun_angkatan').on('change', function() {
            var tahunAngkatan = $(this).val();
            
            if (tahunAngkatan) {
                $.ajax({
                    url: '/get-jurusan-datasiswa/' + tahunAngkatan,  // Sesuaikan dengan fungsi baru
                    type: 'GET',
                    success: function(data) {
                        $('#jurusan').empty();
                        $('#jurusan').append('<option value="" disabled selected>Pilih Jurusan</option>');
                        $('#jurusan_ke').empty();
                        $('#jurusan_ke').append('<option value="" disabled selected>Pilih Jurusan ke</option>');

                        var jurusanSet = new Set();
                        $.each(data, function(index, jurusan) {
                            if (!jurusanSet.has(jurusan.jurusan)) {
                                $('#jurusan').append('<option value="'+ jurusan.jurusan +'">'+ jurusan.jurusan +'</option>');
                                jurusanSet.add(jurusan.jurusan);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + error);
                    }
                });
            }
        });



        $('#jurusan').on('change', function() {
            var jurusan = $(this).val();
            
            if (jurusan) {
                $.ajax({
                    url: '/get-jurusan-ke-datasiswa/' + jurusan,  // Sesuaikan dengan fungsi baru
                    type: 'GET',
                    success: function(data) {
                        $('#jurusan_ke').empty();
                        $('#jurusan_ke').append('<option value="" disabled selected>Pilih Jurusan ke</option>');

                        $.each(data, function(index, jurusanKe) {
                            $('#jurusan_ke').append('<option value="'+ jurusanKe.jurusan_ke +'">'+ jurusanKe.jurusan_ke +'</option>');
                        });
                    }
                });
            }
        });
   </script>
</body>
</html>