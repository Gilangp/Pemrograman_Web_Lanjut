<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Stok</title>
</head>
<body>
    <h1>Data Stok</h1>
    <a href="/stok/tambah">+ Tambah User</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>ID Barang</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>ID User</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Tanggal Stok</th>
            <th>Jumlah Stok</th>
            <th>Aksi</th>
        </tr>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->stok_id }}</td>
                <td>{{ $d->barang->barang_id }}</td>
                <td>{{ $d->barang->barang_kode }}</td>
                <td>{{ $d->barang->barang_nama }}</td>
                <td>{{ $d->user->user_id }}</td>
                <td>{{ $d->user->username }}</td>
                <td>{{ $d->user->nama }}</td>
                <td>{{ $d->stok_tanggal }}</td>
                <td>{{ $d->stok_jumlah }}</td>
                <td><a href="/stok/ubah/{{ $d->stok_id }}">Ubah</a> |
                    <a href="/stok/hapus/{{ $d->stok_id }}">Hapus</a></td>
            </tr>
        @endforeach
    </table>
</body>
</html>
