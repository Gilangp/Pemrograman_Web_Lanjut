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

    <ul> <!-- Membuka daftar tidak berurutan (unordered list) -->
        @foreach ($items as $item) <!-- Melakukan perulangan untuk setiap item dalam variabel $items -->
            <li> <!-- Membuka item dalam daftar -->
                {{ $item->name }} - <!-- Menampilkan nama item -->

                <a href="{{ route('items.edit', $item) }}">Edit</a> <!-- Link untuk mengedit item -->

                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                    <!-- Form untuk menghapus item, menggunakan metode POST -->
                    @csrf <!-- Menyertakan token CSRF untuk keamanan -->
                    @method('DELETE') <!-- Mengubah metode menjadi DELETE agar sesuai dengan Laravel -->
                    <button type="submit">Delete</button> <!-- Tombol untuk menghapus item -->
                </form>
            </li> <!-- Menutup item dalam daftar -->
        @endforeach <!-- Menutup perulangan -->
    </ul> <!-- Menutup daftar tidak berurutan -->
</body>
</html>
