<!DOCTYPE html>
<html>
<head>
    <title>Item List</title> <!-- Menetapkan judul halaman sebagai "Item List" -->
</head>
<body>
    <h1>Items</h1> <!-- Menampilkan judul halaman -->

    @if(session('success')) <!-- Mengecek apakah ada pesan sukses dari session -->
        <p>{{ session('success') }}</p> <!-- Menampilkan pesan sukses jika ada -->
    @endif

    <a href="{{ route('items.create') }}">Add Item</a> <!-- Link untuk menambahkan item baru -->

    <ul>
        @foreach ($items as $item) <!-- Melakukan looping untuk setiap item dalam daftar -->
            <li>
                {{ $item->name }} - <!-- Menampilkan nama item -->

                <a href="{{ route('items.edit', $item) }}">Edit</a> <!-- Link untuk mengedit item -->

                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                    <!-- Form untuk menghapus item, menggunakan method POST -->
                    @csrf <!-- Menyertakan token CSRF untuk keamanan -->
                    @method('DELETE') <!-- Mengubah method menjadi DELETE untuk menghapus item -->
                    <button type="submit">Delete</button> <!-- Tombol untuk menghapus item -->
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
