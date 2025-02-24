<?php

namespace App\Http\Controllers; // Mendefinisikan namespace untuk controller ini agar sesuai dengan struktur Laravel

use App\Models\Item; // Mengimpor model Item agar bisa digunakan dalam controller
use Illuminate\Http\Request; // Mengimpor kelas Request dari Laravel untuk menangani data input dari pengguna

class ItemController extends Controller // Mendefinisikan kelas ItemController yang mewarisi Controller bawaan Laravel
{
    public function index() // Method untuk menampilkan semua item
    {
        $items = Item::all(); // Mengambil semua data dari tabel items menggunakan model Item
        return view('items.index', compact('items')); // Mengembalikan view 'items.index' dengan data items
    }

    public function create() // Method untuk menampilkan form tambah item
    {
        return view('items.create'); // Mengembalikan view 'items.create' yang berisi form input item baru
    }

    public function store(Request $request) // Method untuk menyimpan item baru ke database
    {
        $request->validate([ // Melakukan validasi data input
            'name' => 'required', // Field 'name' wajib diisi
            'description' => 'required', // Field 'description' wajib diisi
        ]);

        Item::create($request->only(['name', 'description'])); // Menyimpan data ke database menggunakan mass assignment
        return redirect()->route('items.index')->with('success', 'Item added successfully.'); // Redirect ke halaman index dengan pesan sukses
    }

    public function show(Item $item) // Method untuk menampilkan detail dari satu item
    {
        return view('items.show', compact('item')); // Mengembalikan view 'items.show' dengan data item yang dipilih
    }

    public function edit(Item $item) // Method untuk menampilkan form edit item
    {
        return view('items.edit', compact('item')); // Mengembalikan view 'items.edit' dengan data item yang akan diedit
    }

    public function update(Request $request, Item $item) // Method untuk memperbarui data item yang ada
    {
        $request->validate([ // Melakukan validasi input sebelum update
            'name' => 'required', // Field 'name' wajib diisi
            'description' => 'required', // Field 'description' wajib diisi
        ]);

        $item->update($request->only(['name', 'description'])); // Memperbarui data item di database
        return redirect()->route('items.index')->with('success', 'Item updated successfully.'); // Redirect ke halaman index dengan pesan sukses
    }

    public function destroy(Item $item) // Method untuk menghapus item dari database
    {
        $item->delete(); // Menghapus item dari database
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.'); // Redirect ke halaman index dengan pesan sukses
    }
}
