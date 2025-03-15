<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kategori</title>
</head>
<body>
    <h1>Data Kategori</h1>
    <a href="/kategori/tambah">+ Tambah Kategori</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Kode Kategori</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->kategori_id }}</td>
            <td>{{ $d->kategori_kode }}</td>
            <td>{{ $d->kategori_nama }}</td>
            <td><a href="/kategori/ubah/{{ $d->kategori_id }}">Ubah</a> |
                <a href="/kategori/hapus/{{ $d->kategori_id }}">Hapus</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>
