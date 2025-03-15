<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Tambah Data Level</title>
</head>
<body>
    <h1>Form Tambah Data Level</h1>
    <form method="post" action="/level/tambah_simpan">

        {{ csrf_field() }}

        <label>Kode Level</label>
        <input type="text" name="level_kode" placeholder="Masukkan Kode Level">
        <br>
        <label>Nama Level</label>
        <input type="text" name="level_nama" placeholder="Masukkan Nama Level">
        <br><br>
        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>
</html>
