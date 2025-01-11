<!DOCTYPE html>
<html>
<head>
    <title>Data Poin</title>
    <style>
        /* CSS untuk styling PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h1>Data Poin Positif</h1>
<table>
    <thead>
        <tr>
            <th>Id Poin</th>
            <th>Keterangan Poin</th>
            <th>Poin</th>
            <th>Kategori Poin</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataPoinPositif as $poin)
        <tr>
            <td>{{ $poin->id_poin_positif }}</td>
            <td>{{ $poin->nama_poin }}</td>
            <td>{{ $poin->poin }}</td>
            <td>{{ $poin->kategori_poin }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h1>Data Poin Negatif</h1>
<table>
    <thead>
        <tr>
            <th>Id Poin</th>
            <th>Nama Poin</th>
            <th>Poin</th>
            <th>Kategori Poin</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataPoinNegatif as $poin)
        <tr>
                <td>{{ $poin->id_poin_negatif }}</td>
                <td>{{ $poin->nama_poin }}</td>
                <td>{{ $poin->poin }}</td>
                <td>{{ $poin->kategori_poin }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
