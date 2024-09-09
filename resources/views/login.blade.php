<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
    <title>Document</title>
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
