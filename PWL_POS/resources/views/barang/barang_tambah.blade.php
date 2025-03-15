<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Tambah Data Barang</title>
</head>
<body>
    <h1>Form Tambah Data Barang</h1>
    <form method="post" action="/barang/tambah_simpan">

        {{ csrf_field() }}

        <label>Kode Barang</label>
        <input type="text" name="barang_kode" placeholder="Masukkan Kode Barang">
        <br>
        <label>Nama Barang</label>
        <input type="text" name="barang_nama" placeholder="Masukkan Nama Barang">
        <br>
        <label>Harga Beli</label>
        <input type="number" name="harga_beli" placeholder="Masukkan Harga Beli">
        <br>
        <label>Harga Jual</label>
        <input type="number" name="harga_jual" placeholder="Masukkan Jual">
        <br>
        <label>ID Kategori</label>
        <input type="number" name="kategori_id" placeholder="Masukkan ID Kategori">
        <br><br>
        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>
</html>
