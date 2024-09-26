<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin/poin/negatif_positif.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="scroll-container">
        <div class="table-wrapper1 scrollable-table1">
            {{-- admin/poin/positif.blade.php --}}
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Kategori</th>
                        <th>Poin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($poinPositif as $poin)
                    <tr>
                        <td><input type="checkbox" name="hapus[]" value="{{ $poin->id_poin }}"></td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $poin->np }}</td>
                        <td>{{ $poin->kategori }}</td>
                        <td>{{ $poin->poin }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>