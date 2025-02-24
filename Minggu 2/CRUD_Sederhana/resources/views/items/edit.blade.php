<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title> <!-- Menetapkan judul halaman sebagai "Edit Item" -->
</head>
<body>
    <h1>Edit Item</h1> <!-- Menampilkan judul halaman -->

    <form action="{{ route('items.update', $item) }}" method="POST"> <!-- Form untuk mengupdate item -->
        @csrf <!-- Menyertakan token CSRF (Cross-Site Request Forgery) untuk keamanan -->
        @method('PUT') <!-- Mengubah metode HTTP menjadi PUT untuk update data -->

        <label for="name">Name:</label> <!-- Label untuk input nama -->
        <input type="text" name="name" value="{{ $item->name }}" required> <!-- Input teks dengan nilai default dari item -->
        <br> <!-- Memberikan spasi antar elemen -->

        <label for="description">Description:</label> <!-- Label untuk input deskripsi -->
        <textarea name="description" required>{{ $item->description }}</textarea> <!-- Input textarea dengan nilai default dari item -->
        <br> <!-- Memberikan spasi antar elemen -->

        <button type="submit">Update Item</button> <!-- Tombol untuk mengupdate item -->
    </form>

    <a href="{{ route('items.index') }}">Back to List</a> <!-- Link untuk kembali ke daftar item -->
</body>
</html>
