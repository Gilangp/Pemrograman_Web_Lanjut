<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Ubah Data Stok</title>
</head>
<body>
    <h1>Form Ubah Data Stok</h1>
    <a href="/stok">Kembali</a>
    <br><br>

    <form method="post" action="/stok/ubah_simpan/{{ $data->stok_id }}">

        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label>ID Barang</label>
        <input type="number" name="barang_id" placeholder="Masukkan ID Barang" value="{{ $data->barang_id }}">
        <br>
        <label>ID User</label>
        <input type="number" name="user_id" placeholder="Masukkan ID User" value="{{ $data->user_id }}">
        <br>
        <label>Tanggal Stok</label>
        <input type="date" name="stok_tanggal" required value="{{ $data->stok_tanggal }}">
        <br>
        <label>Jumlah Stok</label>
        <input type="number" name="stok_jumlah" placeholder="Masukkan Jumlah Stok" value="{{ $data->stok_jumlah }}">
        <br><br>
        <input type="submit" class="btn btn-success" value="Simpan">
    </form>
</body>
</html>
