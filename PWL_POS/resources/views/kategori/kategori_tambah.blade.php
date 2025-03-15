<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Tambah Data Kategori</title>
</head>
<body>
    <h1>Form Tambah Data Kategori</h1>
    <form method="post" action="/kategori/tambah_simpan">

        {{ csrf_field() }}

        <label>Kode Kategori</label>
        <input type="text" name="kategori_kode" placeholder="Masukkan Kode Kategori">
        <br>
        <label>Nama Kategori</label>
        <input type="text" name="kategori_nama" placeholder="Masukkan Nama Kategori">
        <br><br>
        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>
</html>
