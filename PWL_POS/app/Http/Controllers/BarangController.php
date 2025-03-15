<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $data = BarangModel::all();
        return view('barang.index', ['data' => $data]);
    }

    // tambah data
    public function tambah()
    {
        return view('barang.barang_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect('/barang');
    }

    // Edit Data
    public function ubah($id)
    {
        $barang = BarangModel::find($id);
        return view('barang.barang_ubah', ['data' => $barang]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $barang = BarangModel::find($id);

        $barang->barang_kode = $request->barang_kode;
        $barang->barang_nama = $request->barang_nama;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->kategori_id = $request->kategori_id;

        $barang->save();

        return redirect('/barang');
    }

    // Hapus Data
    public function hapus($id)
    {
        $barang = BarangModel::find($id);
        $barang->delete();

        return redirect('/barang');
    }
}
