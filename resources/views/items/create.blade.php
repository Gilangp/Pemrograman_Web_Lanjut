<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title> <!-- Menetapkan judul halaman sebagai "Add Item" -->
</head>
<body>
    <h1>Add Item</h1> <!-- Menampilkan judul halaman -->

    <form action="{{ route('items.store') }}" method="POST"> <!-- Membuat form untuk mengirim data item -->
        @csrf <!-- Menyertakan token CSRF (Cross-Site Request Forgery) untuk keamanan -->

        <label for="name">Name:</label> <!-- Label untuk input nama -->
        <input type="text" name="name" required> <!-- Input teks untuk nama item, wajib diisi -->
        <br> <!-- Memberikan spasi antar elemen -->

        <label for="description">Description:</label> <!-- Label untuk input deskripsi -->
        <textarea name="description" required></textarea> <!-- Input textarea untuk deskripsi item, wajib diisi -->
        <br> <!-- Memberikan spasi antar elemen -->

        <button type="submit">Add Item</button> <!-- Tombol untuk mengirimkan form -->
    </form>

    <a href="{{ route('items.index') }}">Back to List</a> <!-- Link untuk kembali ke daftar item -->
</body>
</html>
