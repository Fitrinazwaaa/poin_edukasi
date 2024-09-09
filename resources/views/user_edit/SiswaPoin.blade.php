<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    @if (Auth::user()->role == 'admin')
    <script>
        window.location.href = "{{ route('BKPage') }}";
        </script>
    @elseif (Auth::user()->role == 'user1')
    <script>
        window.location.href = "{{ route('KesiswaanPage') }}";
        </script>
    @elseif (Auth::user()->role == 'user2')
    <script>
        window.location.href = "{{ route('OsisPage') }}";
        </script>
    @elseif (Auth::user()->role == 'user_edit')
    <div><a href="/logout" class="btn btn-sm btn-secondary">Keluar >></a></div>
    <h1>Tabel Poin!!</h1>
    @endif
</body>
</html>