<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/formulir.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="body">
    @extends('navbar/nav-form')
    <form action="{{ route('submitPoin') }}" method="POST">
    @csrf
    <p class="text-center">FORMULIR INPUT DATA PERATURAN</p>
    <div class="container">
        <div class="form-row">
        <label for="tipe_poin">Tipe Poin:</label>
        <input type="checkbox" class="positif" style="margin-right: 10px;" id="poin_positif" name="type" value="positive"> Positif
<input type="checkbox" class="negatif" style="margin-right: 10px;" id="poin_negatif" name="type" value="negative"> Negatif


        </div>

            <div class="form-row">
                <label for="nama">Id Poin</label>
                <input type="text" name="id_poin" class="form-control" >
            </div>
            
            <div class="form-row">
                <label for="nama">Nama Pelanggaran</label>
                <input type="text" name="np" class="form-control" >
            </div>

            <div class="form-row">
                <label for="nama">Poin</label>
                <input type="text" name="poin" class="form-control" >
            </div>

            <label for="kategori">Kategori:</label>
                 <select id="kategori" name="kategori">
                 <!-- Options will be dynamically filled -->
                 </select><br><br>

            <div class="button-group">
                <button type="button" class="btn-dua" onclick="window.location.href='{{ route('TipePoinSiswa') }}';">Kembali</button>
               <button type="submit" class="btn-dua">Submit</button>
            </div>
    </div>

</form>
<script>
document.getElementById('poin_positif').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('poin_negatif').checked = false;
        updateKategori('positif');
    }
});

document.getElementById('poin_negatif').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('poin_positif').checked = false;
        updateKategori('negatif');
    }
});

function updateKategori(tipePoin) {
    const kategoriDropdown = document.getElementById('kategori');
    kategoriDropdown.innerHTML = ''; // Clear existing options

    let options = [];
    if (tipePoin === 'positif') {
        options = ['A. Prestasi Lomba', 'B. Prestasi Keagamaan', 'C. Prestasi Organisasi', 'D. Perilaku Teladan'];
    } else {
        options = ['A. Pakaian', 'B. Rambut', 'C. Aksesoris', 'D. Pelanggaran Berat'];
    }


    options.forEach(function(option) {
        const newOption = document.createElement('option');
        newOption.value = option;
        newOption.text = option;
        kategoriDropdown.appendChild(newOption);
    });
}
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>



