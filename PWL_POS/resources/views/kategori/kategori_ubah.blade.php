<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Ubah Data Kategori</title>
</head>
<body>
    <h1>Form Ubah Data Kategori</h1>
    <a href="/kategori">Kembali</a>
    <br><br>

    <form method="post" action="/kategori/ubah_simpan/{{ $data->kategori_id }}">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label>Kode Kategori</label>
        <input type="text" name="kategori_kode" placeholder="Masukkan Kode Kategori" value="{{ $data->kategori_kode }}">
        <br>
        <label>Nama Kategori</label>
        <input type="text" name="kategori_nama" placeholder="Masukkan Nama Kategori" value="{{ $data->kategori_nama }}">
        <br><br>
        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>
</html>
