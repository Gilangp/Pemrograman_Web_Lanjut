<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Ubah Data Level</title>
</head>
<body>
    <h1>Form Ubah Data Level</h1>
    <a href="/level">Kembali</a>
    <br><br>

    <form method="post" action="/level/ubah_simpan/{{ $data->level_id }}">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label>Kode Level</label>
        <input type="text" name="level_kode" placeholder="Masukkan Kode Level" value="{{ $data->level_kode }}">
        <br>
        <label>Nama Level</label>
        <input type="text" name="level_nama" placeholder="Masukkan Nama Level" value="{{ $data->level_nama }}">
        <br><br>
        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>
</html>
