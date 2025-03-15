<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Ubah Data Barang</title>
</head>
<body>
    <h1>Form Ubah Data Barang</h1>
    <a href="/barang">Kembali</a>
    <br><br>

    <form method="post" action="/barang/ubah_simpan/{{ $data->barang_id }}">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label>Kode Barang</label>
        <input type="text" name="barang_kode" placeholder="Masukkan Kode Barang" value="{{ $data->barang_kode }}">
        <br>
        <label>Nama Barang</label>
        <input type="text" name="barang_nama" placeholder="Masukkan Nama Barang" value="{{ $data->barang_nama }}">
        <br>
        <label>Harga Beli</label>
        <input type="number" name="harga_beli" placeholder="Masukkan Harga Beli" value="{{ $data->harga_beli }}">
        <br>
        <label>Harga Jual</label>
        <input type="number" name="harga_jual" placeholder="Masukkan Jual" value="{{ $data->harga_jual }}">
        <br>
        <label>ID Kategori</label>
        <input type="number" name="kategori_id" placeholder="Masukkan ID Kategori" value="{{ $data->kategori_id }}">
        <br><br>
        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>
</html>
