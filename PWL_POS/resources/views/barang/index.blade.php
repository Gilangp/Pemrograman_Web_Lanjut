<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Barang</title>
</head>
<body>
    <h1>Data Barang</h1>
    <a href="/barang/tambah">+ Tambah Barang</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>ID Kategori Barang</th>
            <th>Kode Kategori</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->barang_id }}</td>
            <td>{{ $d->barang_kode }}</td>
            <td>{{ $d->barang_nama }}</td>
            <td>{{ $d->harga_beli }}</td>
            <td>{{ $d->harga_jual }}</td>
            <td>{{ $d->kategori->kategori_id }}</td>
            <td>{{ $d->kategori->kategori_kode }}</td>
            <td>{{ $d->kategori->kategori_nama }}</td>
            <td><a href="/barang/ubah/{{ $d->barang_id }}">Ubah</a> |
                <a href="/barang/hapus/{{ $d->barang_id }}">Hapus</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>
