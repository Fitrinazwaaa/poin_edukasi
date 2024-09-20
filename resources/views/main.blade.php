<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-secondary">
    <div class="bg-white container-sm col-6 border my-3 rounded px-5 py-3 pb-5">
        <h1>Halo!!</h1>
        <div>Selamat datang di halaman admin</div>
        <div><a href="/logout" class="btn btn-sm btn-secondary">Keluar >></a></div>
        <div class="card mt-3">
            <ul class="list-group list-group-flush">
                @if (Auth::user()->role == 'admin')
                    <li class="list-group-item">Menu Bimbingan Konseling</li>
                @endif
                @if (Auth::user()->role == 'user2')
                    <li class="list-group-item">Menu OSIS</li>
                @endif
                @if (Auth::user()->role == 'user1')
                    <li class="list-group-item">Menu Kesiswaan</li>
                @endif
                @if (Auth::user()->role == 'user_edit')
                    <li class="list-group-item">Menu Guru</li>
                @endif
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
