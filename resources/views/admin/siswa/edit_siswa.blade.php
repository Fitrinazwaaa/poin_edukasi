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
    @extends('navbar/nav-siswa')
    
    <p class="text-center">FORMULIR EDIT DATA SISWA</p>
    <div class="container">
        <form method="POST" action="{{ route('SiswaUpdate', $data['nis']) }}">
            @csrf
            @method('PUT')

            <div class="form-row">
                <label for="nis">Nis</label>
                <input type="text" name="nis" value="{{ $data['nis'] }}" class="form-control" readonly>
            </div>

            <div class="form-row">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ $data['nama'] }}" class="form-control">
            </div>

            <div class="form-row">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option @if($data['jenis_kelamin']=='Laki-Laki') selected @endif value="Laki-Laki">Laki-Laki</option>
                    <option @if($data['jenis_kelamin']=='Perempuan') selected @endif value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-row">
                <label for="tahun_angkatan">Tahun Angkatan</label>
                <select name="tahun_angkatan" id="tahun_angkatan" class="form-control">
                    <option value="" disabled selected>Pilih Tahun Angkatan</option>
                    @foreach($tahun_angkatan as $tahun)
                        <option value="{{ $tahun }}" @if($data->tahun_angkatan == $tahun) selected @endif>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <label for="kelas">Kelas</label>
                <select name="tingkatan" class="form-control" style="margin-right:30px;">
                    <option value="" style="color: #ccc;" disabled selected>Tingkatan</option>
                    <option value="10" @if($data['tingkatan'] == '10') selected @endif>10</option>
                    <option value="11" @if($data['tingkatan'] == '11') selected @endif>11</option>
                    <option value="12" @if($data['tingkatan'] == '12') selected @endif>12</option>
                </select>
                <select name="jurusan" id="jurusan" class="form-control" style="margin-right:30px;">
                    <option value="" disabled selected>Pilih Jurusan</option>
                    @foreach($jurusan as $satu)
                        <option value="{{ $satu }}" @if($data->jurusan == $satu) selected @endif>
                            {{ $satu }}
                        </option>
                    @endforeach
                </select>
                <select name="jurusan_ke" id="jurusan_ke" class="form-control" >
                    <option value="" disabled selected>Pilih Jurusan ke</option>
                    @foreach($jurusan_ke as $dua)
                        <option value="{{ $dua }}" @if($data->jurusan_ke == $dua) selected @endif>
                            {{ $dua }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="button-group">
                <button type="button" class="btn-dua" onclick="window.location.href='{{ route('Siswa') }}';">Kembali</button>
                <button type="submit" class="btn-satu">Perbaharui</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript">
$(document).ready(function() {
    var tahunAngkatan = $('#tahun_angkatan').val(); // Cek jika tahun angkatan sudah dipilih

    // Jika tahun angkatan sudah ada nilainya, trigger event 'change'
    if (tahunAngkatan) {
        $('#tahun_angkatan').trigger('change');
    }
});

// Ketika tahun_angkatan berubah
$('#tahun_angkatan').on('change', function() {
    var tahunAngkatan = $(this).val();
    
    if (tahunAngkatan) {
        $.ajax({
            url: '/get-jurusan-datasiswa/' + tahunAngkatan,
            type: 'GET',
            success: function(data) {
                var selectedJurusan = $('#jurusan').val(); // Ambil jurusan yang sudah dipilih
                $('#jurusan').empty();
                $('#jurusan').append('<option value="" disabled selected>Pilih Jurusan</option>');

                var jurusanSet = new Set();
                $.each(data, function(index, jurusan) {
                    if (!jurusanSet.has(jurusan.jurusan)) {
                        var isSelected = (jurusan.jurusan == selectedJurusan) ? 'selected' : ''; // Prioritaskan jurusan terpilih
                        $('#jurusan').append('<option value="'+ jurusan.jurusan +'" '+ isSelected +'>'+ jurusan.jurusan +'</option>');
                        jurusanSet.add(jurusan.jurusan);
                    }
                });
                $('#jurusan').prop('disabled', false); // Aktifkan dropdown jurusan
            },
        });
    }
});

// Ketika jurusan berubah
$('#jurusan').on('change', function() {
    var jurusan = $(this).val();
    var tahunAngkatan = $('#tahun_angkatan').val(); // Ambil tahun angkatan yang dipilih
    var selectedJurusanKe = $('#jurusan_ke').val(); // Ambil jurusan ke yang sudah dipilih

    if (jurusan && tahunAngkatan) {
        $.ajax({
            url: '/get-jurusan-ke-datasiswa/' + tahunAngkatan + '/' + jurusan,  // URL diubah untuk mencocokkan tahun angkatan dan jurusan
            type: 'GET',
            success: function(data) {
                $('#jurusan_ke').empty();
                $('#jurusan_ke').append('<option value="" disabled selected>Pilih Jurusan ke</option>');

                var jurusanKeSet = new Set();  // Gunakan Set untuk menghindari duplikasi
                $.each(data, function(index, jurusanKe) {
                    if (!jurusanKeSet.has(jurusanKe.jurusan_ke)) {
                        var isSelectedKe = (jurusanKe.jurusan_ke == selectedJurusanKe) ? 'selected' : ''; // Prioritaskan jurusan_ke terpilih
                        $('#jurusan_ke').append('<option value="'+ jurusanKe.jurusan_ke +'" '+ isSelectedKe +'>'+ jurusanKe.jurusan_ke +'</option>');
                        jurusanKeSet.add(jurusanKe.jurusan_ke);
                    }
                });
                $('#jurusan_ke').prop('disabled', false);
            },
        });
    }
});
   </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>