<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css"> -->
    <title>Document</title>
    <style>
        /* Layer untuk background transparan */
        html::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset('storage/smkn1kawali.png') }}');
            background-size: 700px;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.1; /* Transparansi background */
            z-index: -1; /* Menempatkan layer di belakang konten */
        }

        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

form {
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 7px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 412px;
    position: relative;
    background-color: rgba(255, 255, 255, 0.701); /* Transparansi pada background form */
    z-index: 1; /* Form berada di atas background */
}
.bk-judul {
    position: relative; /* Agar pseudo-elements bisa diposisikan relatif terhadap .bk-judul. */
    width: calc(100% + 84px); /* Lebar .bk-judul lebih lebar dari form. */
    height: 52px;
    background-color: #0579DE;
    color: white;
    text-align: center;
    line-height: 52px; /* Mengatur tinggi garis agar teks berada di tengah secara vertikal. */
    margin-left: -42px; /* Menggeser ke kiri. */
    margin-right: -42px; /* Menggeser ke kanan. */
    margin-bottom: 35px;
    font-size: 20px;
    font-weight: bold;
    border-radius: 7px 7px 0 0;
}

.bk-judul::before,
.bk-judul::after {
    content: ''; /* Membuat pseudo-element kosong. */
    position: absolute;
    border-style: solid;
}

.bk-judul::before {
    top: 52px;
    left: 0px; /* Menempatkan pita di sisi kiri. */
    border-width: 13px 0 0 22px; /* Membuat bentuk segitiga ke luar dari kanan atas. */
    border-color: #004077 transparent transparent transparent; /* Warna segitiga dan transparansi untuk efek pita. */
}

.bk-judul::after {
    top: 52px;
    right: 0; /* Menempatkan pita di sisi kanan. */
    border-width: 13px 22px 0 0; /* Membuat bentuk segitiga ke luar dari kiri atas. */
    border-color: #004077 transparent transparent transparent; /* Warna segitiga dan transparansi untuk efek pita. */
}

.p {
    font-size: 14px; /* Optional: Menetapkan ukuran font agar sesuai dengan desain. */
}

input {
    width: 100%; /* Menetapkan lebar input sama dengan lebar form. */
    padding: 8px; /* Ruang di dalam input untuk kenyamanan pengguna. */
    border-radius: 5px; /* Menyesuaikan sudut input dengan sudut form. */
    border: 1px solid #ccc; /* Border tipis untuk input. */
    background-color: #ffffff; /* Warna latar belakang input. */
    margin-top: 3px; /* Ruang di atas input agar tidak terlalu menempel pada elemen sebelumnya. */
}

.submit-button {
    display: block; /* Membuat tombol tampil sebagai blok untuk menempati lebar penuh form. */
    width: 290px; /* Lebar tombol sesuai dengan lebar form. */
    padding: 10px; /* Ruang di dalam tombol untuk kenyamanan pengguna. */
    margin: 30px auto 20px; 
    border: none; /* Menghapus border default tombol. */
    border-radius: 5px; /* Menyesuaikan sudut tombol dengan sudut form. */
    background-color: #0579DE; /* Warna latar belakang tombol sesuai dengan warna bk-judul. */
    color: white; /* Warna teks tombol. */
    font-size: 16px; /* Ukuran font pada tombol. */
    cursor: pointer; /* Menampilkan pointer saat hover di atas tombol. */
    text-align: center; /* Mengatur teks di dalam tombol agar terpusat. */
}

.submit-button:hover {
    background-color: #0468C8; /* Warna latar belakang tombol saat hover. */
}

.masukan{
    margin-top: 35px;
}
    </style>
</head>
<body>
    <form action="{{ url('/') }}" method="POST">
        @csrf
        <div>
            <div class="bk-judul">
                MASUK AKUN
            </div>
            @if($errors->any())
                <div class="alert alert-danger" style="background-color: rgba(255, 0, 0, 0.174); padding:10px; font-size: 13px; border-radius: 5px">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="masukan">
                <label for="username" class="p">Nama Pengguna</label>
                <input type="text" value="{{ old('username')}}" id="username" name="username" style="margin-bottom: 20px;" required>

                <label for="password" class="p">Kata Sandi</label>
                <input type="password" id="password" name="password" style="margin-bottom: 8px;" required>
                <button type="submit" class="submit-button" name="submit">Kirim</button>
            </div>
        </div>
    </form>
</body>
</html>